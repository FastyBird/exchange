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
Storage events
"""

# Library dependencies
import uuid
from abc import ABC
from whistle import Event
from modules_metadata.types import ModuleOrigin


class StoragePropertyEvent(ABC, Event):
    """
    Base storage for device or channel property

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __property_id: str
    __actual_value: str or int or float or bool or None
    __expected_value: str or int or float or bool or None
    __is_pending: bool

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        property_id: uuid.UUID,
        actual_value: str or int or float or bool or None = None,
        expected_value: str or int or float or bool or None = None,
        is_pending: bool = False,
    ) -> None:
        self.__origin = origin
        self.__property_id = property_id.__str__()
        self.__actual_value = actual_value
        self.__expected_value = expected_value
        self.__is_pending = is_pending

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Origin of module where event was dispatched"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def property_id(self) -> uuid.UUID:
        """Stored property entity identifier"""
        return uuid.UUID(self.__property_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def actual_value(self) -> str or int or float or bool or None:
        """Property actual entity"""
        return self.__actual_value

    # -----------------------------------------------------------------------------

    @property
    def expected_value(self) -> str or int or float or bool or None:
        """Property expected entity"""
        return self.__expected_value

    # -----------------------------------------------------------------------------

    @property
    def is_pending(self) -> bool:
        """Flag notifying that expected value is still pending"""
        return self.__is_pending


class StoragePropertyStoredEvent(StoragePropertyEvent):
    """
    Event fired by storage when property value is written to storage

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """

    EVENT_NAME: str = "storages.propertySaved"


class StorageDevicePropertyStoredEvent(StoragePropertyStoredEvent):
    """
    Event fired by storage when device property value is written to storage

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class StorageChannelPropertyStoredEvent(StoragePropertyStoredEvent):
    """
    Event fired by storage when channel property value is written to storage

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class StoragePropertyPropagatingEvent(StoragePropertyEvent):
    """
    Event fired by storage when property value is requested to be propagated

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """

    EVENT_NAME: str = "storages.propagatingProperty"


class StorageDevicePropertyPropagatingEvent(StoragePropertyPropagatingEvent):
    """
    Event fired by storage when device property is requested to be propagated

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class StorageChannelPropertyPropagatingEvent(StoragePropertyPropagatingEvent):
    """
    Event fired by storage when channel property is requested to be propagated

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class StorageConditionStoredEvent(ABC, Event):
    """
    Event fired by storage when trigger condition validation result is written to storage

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __condition_id: str
    __validation_result: bool

    EVENT_NAME: str = "storages.triggerConditionSaved"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        condition_id: uuid.UUID,
        validation_result: bool,
    ) -> None:
        self.__origin = origin
        self.__condition_id = condition_id.__str__()
        self.__validation_result = validation_result

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Origin of module where event was dispatched"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def condition_id(self) -> uuid.UUID:
        """Stored condition entity identifier"""
        return uuid.UUID(self.__condition_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def validation_result(self) -> bool:
        """Condition validation result"""
        return self.__validation_result


class StorageActionStoredEvent(ABC, Event):
    """
    Event fired by storage when trigger action validation result is written to storage

    @package        FastyBird:ExchangePlugin!
    @module         storages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __action_id: str
    __validation_result: bool

    EVENT_NAME: str = "storages.triggerActionSaved"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        action_id: uuid.UUID,
        validation_result: bool,
    ) -> None:
        self.__origin = origin
        self.__action_id = action_id.__str__()
        self.__validation_result = validation_result

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Origin of module where event was dispatched"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def action_id(self) -> uuid.UUID:
        """Stored action entity identifier"""
        return uuid.UUID(self.__action_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def validation_result(self) -> bool:
        """Condition validation result"""
        return self.__validation_result
