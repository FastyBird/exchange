<?php declare(strict_types = 1);

/**
 * EntityFactory.php
 *
 * @license        More in LICENSE.md
 * @copyright      https://www.fastybird.com
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 * @package        FastyBird:Exchange!
 * @subpackage     Entities
 * @since          0.44.0
 *
 * @date           13.06.22
 */

namespace FastyBird\Exchange\Entities;

use FastyBird\Exchange\Exceptions;
use FastyBird\Metadata\Entities as MetadataEntities;
use FastyBird\Metadata\Exceptions as MetadataExceptions;
use FastyBird\Metadata\Types as MetadataTypes;

/**
 * Exchange entity factory
 *
 * @package        FastyBird:Exchange!
 * @subpackage     Entities
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
final class EntityFactory
{

	public function __construct(
		private MetadataEntities\Actions\ActionConnectorControlEntityFactory $actionConnectorControlEntityFactory,
		private MetadataEntities\Actions\ActionConnectorPropertyEntityFactory $actionConnectorPropertyEntityFactory,
		private MetadataEntities\Actions\ActionDeviceControlEntityFactory $actionDeviceControlEntityFactory,
		private MetadataEntities\Actions\ActionDevicePropertyEntityFactory $actionDevicePropertyEntityFactory,
		private MetadataEntities\Actions\ActionChannelControlEntityFactory $actionChannelControlEntityFactory,
		private MetadataEntities\Actions\ActionChannelPropertyEntityFactory $actionChannelPropertyEntityFactory,
		private MetadataEntities\Actions\ActionTriggerControlEntityFactory $actionTriggerControlEntityFactory,
		private MetadataEntities\AccountsModule\AccountEntityFactory $accountEntityFactory,
		private MetadataEntities\AccountsModule\EmailEntityFactory $emailEntityFactory,
		private MetadataEntities\AccountsModule\IdentityEntityFactory $identityEntityFactory,
		private MetadataEntities\AccountsModule\RoleEntityFactory $roleEntityFactory,
		private MetadataEntities\TriggersModule\ActionEntityFactory $triggerActionEntityFactory,
		private MetadataEntities\TriggersModule\ConditionEntityFactory $triggerConditionEntityFactory,
		private MetadataEntities\TriggersModule\NotificationEntityFactory $triggerNotificationEntityFactory,
		private MetadataEntities\TriggersModule\TriggerControlEntityFactory $triggerControlEntityFactory,
		private MetadataEntities\TriggersModule\TriggerEntityFactory $triggerEntityFactory,
		private MetadataEntities\DevicesModule\ConnectorEntityFactory $connectorEntityFactory,
		private MetadataEntities\DevicesModule\ConnectorControlEntityFactory $connectorControlEntityFactory,
		private MetadataEntities\DevicesModule\ConnectorPropertyEntityFactory $connectorPropertyEntityFactory,
		private MetadataEntities\DevicesModule\DeviceEntityFactory $deviceEntityFactory,
		private MetadataEntities\DevicesModule\DeviceControlEntityFactory $deviceControlEntityFactory,
		private MetadataEntities\DevicesModule\DevicePropertyEntityFactory $devicePropertyEntityFactory,
		private MetadataEntities\DevicesModule\DeviceAttributeEntityFactory $deviceAttributeEntityFactory,
		private MetadataEntities\DevicesModule\ChannelEntityFactory $channelEntityFactory,
		private MetadataEntities\DevicesModule\ChannelControlEntityFactory $channelControlEntityFactory,
		private MetadataEntities\DevicesModule\ChannelPropertyEntityFactory $channelPropertyEntityFactory,
	)
	{
	}

	/**
	 * @throws MetadataExceptions\FileNotFound
	 */
	public function create(string $data, MetadataTypes\RoutingKey $routingKey): MetadataEntities\Entity
	{
		// ACTIONS
		if ($routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_CONTROL_ACTION)) {
			return $this->actionConnectorControlEntityFactory->create($data);
		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_PROPERTY_ACTION)) {
			return $this->actionConnectorPropertyEntityFactory->create($data);
		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_CONTROL_ACTION)) {
			return $this->actionDeviceControlEntityFactory->create($data);
		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_PROPERTY_ACTION)) {
			return $this->actionDevicePropertyEntityFactory->create($data);
		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_CONTROL_ACTION)) {
			return $this->actionChannelControlEntityFactory->create($data);
		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_PROPERTY_ACTION)) {
			return $this->actionChannelPropertyEntityFactory->create($data);
		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONTROL_ACTION)) {
			return $this->actionTriggerControlEntityFactory->create($data);

			// ACCOUNTS MODULE
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ACCOUNT_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ACCOUNT_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ACCOUNT_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ACCOUNT_ENTITY_DELETED)
		) {
			return $this->accountEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_EMAIL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_EMAIL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_EMAIL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_EMAIL_ENTITY_DELETED)
		) {
			return $this->emailEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_IDENTITY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_IDENTITY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_IDENTITY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_IDENTITY_ENTITY_DELETED)
		) {
			return $this->identityEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ROLE_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ROLE_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ROLE_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_ROLE_ENTITY_DELETED)
		) {
			return $this->roleEntityFactory->create($data);

			// DEVICES MODULE
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ENTITY_DELETED)
		) {
			return $this->deviceEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_PROPERTY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_PROPERTY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_PROPERTY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_PROPERTY_ENTITY_DELETED)
		) {
			return $this->devicePropertyEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_CONTROL_ENTITY_DELETED)
		) {
			return $this->deviceControlEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ATTRIBUTE_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ATTRIBUTE_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ATTRIBUTE_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_DEVICE_ATTRIBUTE_ENTITY_DELETED)
		) {
			return $this->deviceAttributeEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_ENTITY_DELETED)
		) {
			return $this->channelEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_PROPERTY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_PROPERTY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_PROPERTY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_PROPERTY_ENTITY_DELETED)
		) {
			return $this->channelPropertyEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CHANNEL_CONTROL_ENTITY_DELETED)
		) {
			return $this->channelControlEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_ENTITY_DELETED)
		) {
			return $this->connectorEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_PROPERTY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_PROPERTY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_PROPERTY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_PROPERTY_ENTITY_DELETED)
		) {
			return $this->connectorPropertyEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_CONNECTOR_CONTROL_ENTITY_DELETED)
		) {
			return $this->connectorControlEntityFactory->create($data);

			// TRIGGERS MODULE
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ENTITY_DELETED)
		) {
			return $this->triggerEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONTROL_ENTITY_DELETED)
		) {
			return $this->triggerControlEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ACTION_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ACTION_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ACTION_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_ACTION_ENTITY_DELETED)
		) {
			return $this->triggerActionEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_NOTIFICATION_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_NOTIFICATION_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_NOTIFICATION_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_NOTIFICATION_ENTITY_DELETED)
		) {
			return $this->triggerNotificationEntityFactory->create($data);
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONDITION_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONDITION_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONDITION_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKey::ROUTE_TRIGGER_CONDITION_ENTITY_DELETED)
		) {
			return $this->triggerConditionEntityFactory->create($data);
		}

		throw new Exceptions\InvalidState('Entity could not be created');
	}

}
