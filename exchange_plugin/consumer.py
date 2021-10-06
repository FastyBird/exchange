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
Messages publisher proxy
"""

# Library dependencies
from abc import ABC
from typing import Dict
from modules_metadata.routing import RoutingKey
from modules_metadata.types import ModuleOrigin


class IConsumer(ABC):
    """
    Exchange consumer interface

    @package        FastyBird:ExchangePlugin!
    @module         publisher

    @author         Adam Kadlec <adam.kadlec@fastybird.com>
    """
    def publish(
        self,
        origin: ModuleOrigin,
        routing_key: RoutingKey,
        data: Dict,
    ) -> None:
        """Consume data from exchange bus"""
