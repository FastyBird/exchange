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
Triggers module events
"""

# Library dependencies
import uuid
from abc import ABC
from whistle import Event


class TriggerPropertyActionFiredEvent(ABC, Event):
    """
    Event fired by triggers handler when trigger property action is fired

    @package        FastyBird:ExchangePlugin!
    @module         triggers

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    __property_id: str
    __expected_value: str

    EVENT_NAME: str = "triggers.propertyActionFired"

    # -----------------------------------------------------------------------------

    def __init__(
        self,
        property_id: uuid.UUID,
        expected_value: str,
    ) -> None:
        self.__property_id = property_id.__str__()
        self.__expected_value = expected_value

    # -----------------------------------------------------------------------------

    @property
    def property_id(self) -> uuid.UUID:
        """Property entity identifier"""
        return uuid.UUID(self.__property_id, version=4)

    # -----------------------------------------------------------------------------

    @property
    def expected_value(self) -> str:
        """Expected property value"""
        return self.__expected_value


class TriggerDevicePropertyActionFiredEvent(TriggerPropertyActionFiredEvent):
    """
    Event fired by triggers handler when trigger device property action is fired

    @package        FastyBird:ExchangePlugin!
    @module         triggers

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """


class TriggerChannelPropertyActionFiredEvent(TriggerPropertyActionFiredEvent):
    """
    Event fired by triggers handler when trigger channel property action is fired

    @package        FastyBird:ExchangePlugin!
    @module         triggers

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
