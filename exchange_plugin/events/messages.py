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
Exchange plugin exchange messages events
"""

# Library dependencies
from typing import Dict, Optional
from modules_metadata.routing import RoutingKey
from modules_metadata.types import ModuleOrigin

# Library libs
from exchange_plugin.events.event import IEvent


class MessageEvent(IEvent):
    """
    Base message event

    @package        FastyBird:ExchangePlugin!
    @module         messages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __origin: ModuleOrigin
    __routing_key: RoutingKey
    __data: Optional[Dict]

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        origin: ModuleOrigin,
        routing_key: RoutingKey,
        data: Optional[Dict],
    ) -> None:
        self.__origin = origin
        self.__routing_key = routing_key
        self.__data = data

    # -----------------------------------------------------------------------------

    @property
    def origin(self) -> ModuleOrigin:
        """Message origin"""
        return self.__origin

    # -----------------------------------------------------------------------------

    @property
    def routing_key(self) -> RoutingKey:
        """Message routing key"""
        return self.__routing_key

    # -----------------------------------------------------------------------------

    @property
    def data(self) -> Optional[Dict]:
        """Message data"""
        return self.__data


class MessageConsumedEvent(MessageEvent):
    """
    Event fired by exchange when received message is consumed

    @package        FastyBird:ExchangePlugin!
    @module         messages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    EVENT_NAME: str = "exchange-plugin.messages.messageConsumed"


class MessagePublishedEvent(MessageEvent):
    """
    Event fired by exchange when received message is published

    @package        FastyBird:ExchangePlugin!
    @module         messages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    EVENT_NAME: str = "exchange-plugin.messages.messagePublished"


class MessageReceivedEvent(MessageEvent):
    """
    Event fired by exchange client when message is received

    @package        FastyBird:ExchangePlugin!
    @module         messages

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    EVENT_NAME: str = "exchange-plugin.messages.messageReceived"
