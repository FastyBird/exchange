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
Data exchange events
"""

# Library dependencies
import uuid
from abc import ABC
from modules_metadata.routing import RoutingKey
from modules_metadata.types import ModuleOrigin
from whistle import Event


class ExchangePropertyExpectedValueEvent(ABC, Event):
    """
    Event fired by exchange when set property message is received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __property_id: str
    __expected_value: str or int or float or bool

    EVENT_NAME: str = "exchanges.expectedPropertyValue"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        property_id: uuid.UUID,
        expected_value: str or int or float or bool,
    ) -> None:
        self.__origin = origin
        self.__property_id = property_id.__str__()
        self.__expected_value = expected_value

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Origin of module where event was dispatched"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def property_id(self) -> uuid.UUID:
        """Property entity identifier"""
        return uuid.UUID(self.__property_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def expected_value(self) -> str or int or float or bool:
        """Value to be set to property"""
        return self.__expected_value


class ExchangeDevicePropertyExpectedValueEvent(ExchangePropertyExpectedValueEvent):
    """
    Event fired by exchange when set device property message is received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ExchangeChannelPropertyExpectedValueEvent(ExchangePropertyExpectedValueEvent):
    """
    Event fired by exchange when set channel property message is received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ExchangeConnectorControlEvent(ABC, Event):
    """
    Event fired by exchange when control connector message is received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __connector_id: str
    __value: str or None

    EVENT_NAME: str = "exchanges.controlConnector"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        connector_id: uuid.UUID,
        value: str or None = None,
    ) -> None:
        self.__origin = origin
        self.__connector_id = connector_id.__str__()
        self.__value = value

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Origin of module where event was dispatched"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def connector_id(self) -> uuid.UUID:
        """Connector entity identifier"""
        return uuid.UUID(self.__connector_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def value(self) -> str or None:
        """Connector control command value"""
        return self.__value


class ExchangeConnectorControlSearchDevicesEvent(ExchangeConnectorControlEvent):
    """
    Event fired by exchange when search for new devices command is received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ExchangeConnectorControlResetEvent(ExchangeConnectorControlEvent):
    """
    Event fired by exchange when reset connector command is received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ExchangeEntityEvent(ABC, Event):
    """
    Event fired by exchange when entity message received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __data: dict
    __routing_key: RoutingKey

    EVENT_NAME: str = "exchanges.entity"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        data: dict,
        routing_key: RoutingKey,
    ) -> None:
        self.__origin = origin
        self.__data = data
        self.__routing_key = routing_key

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Origin of module which send message to exchange"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def data(self) -> dict:
        """JSON representation of entity data"""
        return self.__data

    # -----------------------------------------------------------------------------

    @property
    def routing_key(self) -> RoutingKey:
        """Message routing key"""
        return self.__routing_key


class ExchangeEntityCreatedEvent(ExchangeEntityEvent):
    """
    Event fired by exchange when entity created message received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ExchangeEntityUpdatedEvent(ExchangeEntityEvent):
    """
    Event fired by exchange when entity updated message received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class ExchangeEntityDeletedEvent(ExchangeEntityEvent):
    """
    Event fired by exchange when entity deleted message received

    @package        FastyBird:ExchangePlugin!
    @module         exchanges

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
