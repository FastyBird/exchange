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
Exchange plugin events dispatcher
"""

# Python base dependencies
from typing import Callable

# Library dependencies
from kink import inject
from whistle import Event
from whistle import EventDispatcher as WhistleEventDispatcher

# Library libs
from exchange_plugin.events.event import IEvent


@inject
class EventDispatcher:
    """
    Custom events dispatcher

    @package        FastyBird:ExchangePlugin!
    @module         dispatcher

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """

    __dispatcher: WhistleEventDispatcher

    # -----------------------------------------------------------------------------

    def __init__(self) -> None:
        self.__dispatcher = WhistleEventDispatcher()

    # -----------------------------------------------------------------------------

    def dispatch(
        self,
        event_id: str,
        event: IEvent,
    ) -> None:
        """Dispatch custom event"""
        self.__dispatcher.dispatch(event_id=event_id, event=event)

    # -----------------------------------------------------------------------------

    def add_listener(
        self,
        event_id: str,
        listener: Callable[[Event], None],
        priority: int = 0,
    ) -> None:
        """Register event listener to dispatcher"""
        self.__dispatcher.add_listener(event_id=event_id, listener=listener, priority=priority)

    # -----------------------------------------------------------------------------

    def remove_listener(
        self,
        event_id: str,
        listener: Callable[[Event], None],
    ) -> None:
        """Unregister event listener from dispatcher"""
        self.__dispatcher.remove_listener(event_id=event_id, listener=listener)

    # -----------------------------------------------------------------------------

    def has_listeners(
        self,
        event_id: str,
    ) -> bool:
        """Check if for given event id is registered any listener"""
        return self.__dispatcher.has_listeners(event_id=event_id)
