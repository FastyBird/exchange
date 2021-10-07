#!/usr/bin/python3

#     Copyright 2021. FastyBird s.r.o.
#
#     Licensed under the Apache License, Version 2.0 (the "License");
#     you may not use this file except in compliance with the License.
#     You may obtain a copy of the License at
#
#         http://www.apache.org/licenses/LICENSE-2.0
#
#     Unless required by applicable law or agreed to in writing, software
#     distributed under the License is distributed on an "AS IS" BASIS,
#     WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
#     See the License for the specific language governing permissions and
#     limitations under the License.

"""
Communication connectors events
"""

# Library dependencies
import uuid
from abc import ABC
from typing import Dict
from modules_metadata.types import DataType, ModuleOrigin

# Library libs
from exchange_plugin.events.event import IEvent


class ConnectorPropertyValueEvent(ABC, IEvent):
    """
    Event fired by connected when property value is updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __property_id: str
    __actual_value: str or int or float or bool
    __previous_value: str or int or float or bool or None

    EVENT_NAME: str = "connectors.propertyValue"

    def __init__(
        self,
        origin: ModuleOrigin,
        property_id: uuid.UUID,
        actual_value: str or int or float or bool,
        previous_value: str or int or float or bool or None,
    ) -> None:
        self.__origin = origin
        self.__property_id = property_id.__str__()
        self.__actual_value = actual_value
        self.__previous_value = previous_value

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Origin of module where event was dispatched"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def property_id(self) -> uuid.UUID:
        """Changed property entity"""
        return uuid.UUID(self.__property_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def actual_value(self) -> str or int or float or bool:
        """Property new value"""
        return self.__actual_value

    # -----------------------------------------------------------------------------

    @property
    def previous_value(self) -> str or int or float or bool or None:
        """Property previous value"""
        return self.__previous_value


class ConnectorDevicePropertyValueEvent(ConnectorPropertyValueEvent):
    """
    Event fired by connected when device property value is updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorChannelPropertyValueEvent(ConnectorPropertyValueEvent):
    """
    Event fired by connected when channel property value is updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorPropertyUpdatedEvent(ABC, IEvent):
    """
    Event fired by connector when property new value is received

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __property_id: str
    __actual_value: str or int or float or bool
    __previous_value: str or int or float or bool or None = None

    EVENT_NAME: str = "connectors.internal.propertyUpdated"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        property_id: uuid.UUID,
        actual_value: str or int or float or bool or None,
        previous_value: str or int or float or bool or None = None,
    ) -> None:
        self.__property_id = property_id.__str__()
        self.__actual_value = actual_value
        self.__previous_value = previous_value

    # -----------------------------------------------------------------------------

    @property
    def property_id(self) -> uuid.UUID:
        """Updated property entity"""
        return uuid.UUID(self.__property_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def actual_value(self) -> str or int or float or bool:
        """Property actual entity"""
        return self.__actual_value

    # -----------------------------------------------------------------------------

    @property
    def previous_value(self) -> str or int or float or bool or None:
        """Property previous entity"""
        return self.__previous_value


class ConnectorDevicePropertyUpdatedEvent(ConnectorPropertyUpdatedEvent):
    """
    Event fired by connector when device property new value is received

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorChannelPropertyUpdatedEvent(ConnectorPropertyUpdatedEvent):
    """
    Event fired by connector when channel property new value is received

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorAddOrEditDevice(ABC, IEvent):
    """
    Event fired by connector when new device is connected or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __connector_id: str
    __device_id: str
    __identifier: str
    __connector_params: Dict = {}
    __hardware_manufacturer: str or None = None
    __hardware_model: str or None = None
    __hardware_version: str or None = None
    __firmware_manufacturer: str or None = None
    __firmware_version: str or None = None

    EVENT_NAME: str = "connector.addOrEditDevice"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        connector_id: uuid.UUID,
        device_id: uuid.UUID,
        identifier: str,
        connector_params: Dict,
        hardware_manufacturer: str or None = None,
        hardware_model: str or None = None,
        hardware_version: str or None = None,
        firmware_manufacturer: str or None = None,
        firmware_version: str or None = None,
    ) -> None:
        self.__connector_id = connector_id.__str__()
        self.__device_id = device_id.__str__()
        self.__identifier = identifier

        self.__connector_params = connector_params

        self.__hardware_manufacturer = hardware_manufacturer
        self.__hardware_model = hardware_model
        self.__hardware_version = hardware_version

        self.__firmware_manufacturer = firmware_manufacturer
        self.__firmware_version = firmware_version

    # -----------------------------------------------------------------------------

    @property
    def connector_id(self) -> uuid.UUID:
        """Device connector identifier"""
        return uuid.UUID(self.__connector_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def device_id(self) -> uuid.UUID:
        """Device identifier"""
        return uuid.UUID(self.__device_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def identifier(self) -> str:
        """Device unique identifier"""
        return self.__identifier

    # -----------------------------------------------------------------------------

    @property
    def connector_params(self) -> Dict:
        """Device connector params"""
        return self.__connector_params

    # -----------------------------------------------------------------------------

    @property
    def hardware_manufacturer(self) -> str or None:
        """Device hardware manufacturer"""
        return self.__hardware_manufacturer

    # -----------------------------------------------------------------------------

    @property
    def hardware_model(self) -> str or None:
        """Device hardware model"""
        return self.__hardware_model

    # -----------------------------------------------------------------------------

    @property
    def hardware_version(self) -> str or None:
        """Device hardware version"""
        return self.__hardware_version

    # -----------------------------------------------------------------------------

    @property
    def firmware_manufacturer(self) -> str or None:
        """Device firmware manufacturer"""
        return self.__firmware_manufacturer

    # -----------------------------------------------------------------------------

    @property
    def firmware_version(self) -> str or None:
        """Device firmware version"""
        return self.__firmware_version


class ConnectorAddOrEditChannel(ABC, IEvent):
    """
    Event fired by connector when new channel is created or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __device_id: str
    __channel_id: str
    __channel_identifier: str

    EVENT_NAME: str = "connector.addOrEditChannel"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        device_id: uuid.UUID,
        channel_id: uuid.UUID,
        channel_identifier: str,
    ) -> None:
        self.__device_id = device_id.__str__()
        self.__channel_id = channel_id.__str__()
        self.__channel_identifier = channel_identifier

    # -----------------------------------------------------------------------------

    @property
    def device_id(self) -> uuid.UUID:
        """Device identifier"""
        return uuid.UUID(self.__device_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def channel_id(self) -> uuid.UUID:
        """Device identifier"""
        return uuid.UUID(self.__channel_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def channel_identifier(self) -> str:
        """Device identifier"""
        return self.__channel_identifier


class ConnectorAddOrEditProperty(ABC, IEvent):
    """
    Event fired by connector when new property is created or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __device_id: str
    __property_id: str
    __property_identifier: str
    __property_key: str or None = None
    __property_settable: bool = False
    __property_queryable: bool = False
    __value_data_type: DataType or None = None
    __value_unit: str or None = None
    __value_format: str or None = None

    EVENT_NAME: str = "connector.addOrEditProperty"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        device_id: uuid.UUID,
        property_id: uuid.UUID,
        property_identifier: str,
        property_key: str or None = None,
        property_settable: bool = False,
        property_queryable: bool = False,
        value_data_type: DataType or None = None,
        value_unit: str or None = None,
        value_format: str or None = None,
    ) -> None:
        self.__device_id = device_id.__str__()
        self.__property_id = property_id.__str__()
        self.__property_identifier = property_identifier
        self.__property_key = property_key
        self.__property_settable = property_settable
        self.__property_queryable = property_queryable
        self.__value_data_type = value_data_type
        self.__value_unit = value_unit
        self.__value_format = value_format

    # -----------------------------------------------------------------------------

    @property
    def device_id(self) -> uuid.UUID:
        """Device identifier"""
        return uuid.UUID(self.__device_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def property_id(self) -> uuid.UUID:
        """Property identifier"""
        return uuid.UUID(self.__property_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def property_identifier(self) -> str:
        """Property unique identifier"""
        return self.__property_identifier

    # -----------------------------------------------------------------------------

    @property
    def property_key(self) -> str or None:
        """Property unique key"""
        return self.__property_key

    # -----------------------------------------------------------------------------

    @property
    def property_settable(self) -> bool:
        """Is property settable"""
        return self.__property_settable

    # -----------------------------------------------------------------------------

    @property
    def property_queryable(self) -> bool:
        """Is property queryable"""
        return self.__property_queryable

    # -----------------------------------------------------------------------------

    @property
    def value_data_type(self) -> DataType or None:
        """Is property queryable"""
        return self.__value_data_type

    # -----------------------------------------------------------------------------

    @property
    def value_unit(self) -> str or None:
        """Property value unit"""
        return self.__value_unit

    # -----------------------------------------------------------------------------

    @property
    def value_format(self) -> str or None:
        """Property value format"""
        return self.__value_format


class ConnectorAddOrEditDeviceProperty(ConnectorAddOrEditProperty):
    """
    Event fired by connector when new device property is created or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorAddOrEditChannelProperty(ConnectorAddOrEditProperty):
    """
    Event fired by connector when new channel property is created or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __channel_id: str

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        device_id: uuid.UUID,
        channel_id: uuid.UUID,
        property_id: uuid.UUID,
        property_identifier: str,
        property_key: str,
        property_settable: bool = False,
        property_queryable: bool = False,
        value_data_type: DataType or None = None,
        value_unit: str or None = None,
        value_format: str or None = None,
    ) -> None:
        super().__init__(
            device_id=device_id,
            property_id=property_id,
            property_identifier=property_identifier,
            property_key=property_key,
            property_settable=property_settable,
            property_queryable=property_queryable,
            value_data_type=value_data_type,
            value_unit=value_unit,
            value_format=value_format,
        )

        self.__channel_id = channel_id.__str__()

    # -----------------------------------------------------------------------------

    @property
    def channel_id(self) -> uuid.UUID:
        """Property identifier"""
        return uuid.UUID(self.__channel_id, version=4)


class ConnectorDeleteProperty(ABC, IEvent):
    """
    Event fired by connector when property is deleted

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __property_id: str

    EVENT_NAME: str = "connector.deleteProperty"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        property_id: uuid.UUID,
    ) -> None:
        self.__property_id = property_id.__str__()

    # -----------------------------------------------------------------------------

    @property
    def property_id(self) -> uuid.UUID:
        """Property identifier"""
        return uuid.UUID(self.__property_id, version=4)


class ConnectorDeleteDeviceProperty(ConnectorDeleteProperty):
    """
    Event fired by connector when device property is deleted

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorDeleteChannelProperty(ConnectorDeleteProperty):
    """
    Event fired by connector when channel property is deleted

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorAddOrEditConfiguration(ABC, IEvent):
    """
    Event fired by connector when new configuration is created or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __device_id: str
    __configuration_id: str
    __configuration_identifier: str
    __value_data_type: DataType or None = None

    EVENT_NAME: str = "connector.addOrEditConfiguration"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        device_id: uuid.UUID,
        configuration_id: uuid.UUID,
        configuration_identifier: str,
        value_data_type: DataType or None = None,
    ) -> None:
        self.__device_id = device_id.__str__()
        self.__configuration_id = configuration_id.__str__()
        self.__configuration_identifier = configuration_identifier
        self.__value_data_type = value_data_type

    # -----------------------------------------------------------------------------

    @property
    def device_id(self) -> uuid.UUID:
        """Device identifier"""
        return uuid.UUID(self.__device_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def configuration_id(self) -> uuid.UUID:
        """Configuration identifier"""
        return uuid.UUID(self.__configuration_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def configuration_identifier(self) -> str:
        """Configuration identifier"""
        return self.__configuration_identifier

    # -----------------------------------------------------------------------------

    @property
    def value_data_type(self) -> DataType or None:
        """Configuration value data type"""
        return self.__value_data_type


class ConnectorAddOrEditDeviceConfiguration(ConnectorAddOrEditConfiguration):
    """
    Event fired by connector when new device configuration is created or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorAddOrEditChannelConfiguration(ConnectorAddOrEditConfiguration):
    """
    Event fired by connector when new channel configuration is created or existing updated

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __channel_id: str

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        device_id: uuid.UUID,
        channel_id: uuid.UUID,
        configuration_id: uuid.UUID,
        configuration_identifier: str,
        value_data_type: DataType or None = None,
    ) -> None:
        super().__init__(
            device_id=device_id,
            configuration_id=configuration_id,
            configuration_identifier=configuration_identifier,
            value_data_type=value_data_type,
        )

        self.__channel_id = channel_id.__str__()

    # -----------------------------------------------------------------------------

    @property
    def channel_id(self) -> uuid.UUID:
        """Channel identifier"""
        return uuid.UUID(self.__channel_id, version=4)


class ConnectorDeleteConfiguration(ABC, IEvent):
    """
    Event fired by connector when configuration is deleted

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __configuration_id: str

    EVENT_NAME: str = "connector.deleteConfiguration"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        configuration_id: uuid.UUID,
    ) -> None:
        self.__configuration_id = configuration_id.__str__()

    # -----------------------------------------------------------------------------

    @property
    def configuration_id(self) -> uuid.UUID:
        """Configuration identifier"""
        return uuid.UUID(self.__configuration_id, version=4)


class ConnectorDeleteDeviceConfiguration(ConnectorDeleteConfiguration):
    """
    Event fired by connector when device configuration is deleted

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ConnectorDeleteChannelConfiguration(ConnectorDeleteConfiguration):
    """
    Event fired by connector when channel configuration is deleted

    @package        FastyBird:ExchangePlugin!
    @module         connectors

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
