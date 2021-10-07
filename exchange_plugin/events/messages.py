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
Messages events
"""

# Library dependencies
from typing import Dict
from modules_metadata.routing import RoutingKey
from modules_metadata.types import ModuleOrigin

# Library libs
from exchange_plugin.events.event import IEvent


class MessageConsumed(IEvent):
    """
    Event fired by exchange when received message is consumed

    @package        FastyBird:ExchangePlugin!
    @module         messages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __routing_key: RoutingKey
    __data: Dict

    EVENT_NAME: str = "messages.messageConsumed"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        routing_key: RoutingKey,
        data: Dict,
    ) -> None:
        self.__origin = origin
        self.__routing_key = routing_key
        self.__data = data

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def routing_key(self) -> RoutingKey:
        return self.__routing_key

    # -----------------------------------------------------------------------------

    @property
    def data(self) -> Dict:
        return self.__data


class MessagePublished(IEvent):
    """
    Event fired by exchange when received message is published

    @package        FastyBird:ExchangePlugin!
    @module         messages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __routing_key: RoutingKey
    __data: Dict

    EVENT_NAME: str = "messages.messagePublished"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        routing_key: RoutingKey,
        data: Dict,
    ) -> None:
        self.__origin = origin
        self.__routing_key = routing_key
        self.__data = data

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def routing_key(self) -> RoutingKey:
        return self.__routing_key

    # -----------------------------------------------------------------------------

    @property
    def data(self) -> Dict:
        return self.__data
