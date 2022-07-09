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

	/** @var MetadataEntities\Actions\ActionConnectorControlEntityFactory */
	private MetadataEntities\Actions\ActionConnectorControlEntityFactory $actionConnectorControlEntityFactory;

	/** @var MetadataEntities\Actions\ActionConnectorPropertyEntityFactory */
	private MetadataEntities\Actions\ActionConnectorPropertyEntityFactory $actionConnectorPropertyEntityFactory;

	/** @var MetadataEntities\Actions\ActionDeviceControlEntityFactory */
	private MetadataEntities\Actions\ActionDeviceControlEntityFactory $actionDeviceControlEntityFactory;

	/** @var MetadataEntities\Actions\ActionDevicePropertyEntityFactory */
	private MetadataEntities\Actions\ActionDevicePropertyEntityFactory $actionDevicePropertyEntityFactory;

	/** @var MetadataEntities\Actions\ActionChannelControlEntityFactory */
	private MetadataEntities\Actions\ActionChannelControlEntityFactory $actionChannelControlEntityFactory;

	/** @var MetadataEntities\Actions\ActionChannelPropertyEntityFactory */
	private MetadataEntities\Actions\ActionChannelPropertyEntityFactory $actionChannelPropertyEntityFactory;

	/** @var MetadataEntities\Actions\ActionTriggerControlEntityFactory */
	private MetadataEntities\Actions\ActionTriggerControlEntityFactory $actionTriggerControlEntityFactory;

	/** @var MetadataEntities\Modules\AccountsModule\AccountEntityFactory */
	private MetadataEntities\Modules\AccountsModule\AccountEntityFactory $accountEntityFactory;

	/** @var MetadataEntities\Modules\AccountsModule\EmailEntityFactory */
	private MetadataEntities\Modules\AccountsModule\EmailEntityFactory $emailEntityFactory;

	/** @var MetadataEntities\Modules\AccountsModule\IdentityEntityFactory */
	private MetadataEntities\Modules\AccountsModule\IdentityEntityFactory $identityEntityFactory;

	/** @var MetadataEntities\Modules\AccountsModule\RoleEntityFactory */
	private MetadataEntities\Modules\AccountsModule\RoleEntityFactory $roleEntityFactory;

	/** @var MetadataEntities\Modules\TriggersModule\ActionEntityFactory */
	private MetadataEntities\Modules\TriggersModule\ActionEntityFactory $triggerActionEntityFactory;

	/** @var MetadataEntities\Modules\TriggersModule\ConditionEntityFactory */
	private MetadataEntities\Modules\TriggersModule\ConditionEntityFactory $triggerConditionEntityFactory;

	/** @var MetadataEntities\Modules\TriggersModule\NotificationEntityFactory */
	private MetadataEntities\Modules\TriggersModule\NotificationEntityFactory $triggerNotificationEntityFactory;

	/** @var MetadataEntities\Modules\TriggersModule\TriggerControlEntityFactory */
	private MetadataEntities\Modules\TriggersModule\TriggerControlEntityFactory $triggerControlEntityFactory;

	/** @var MetadataEntities\Modules\TriggersModule\TriggerEntityFactory */
	private MetadataEntities\Modules\TriggersModule\TriggerEntityFactory $triggerEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\ConnectorEntityFactory */
	private MetadataEntities\Modules\DevicesModule\ConnectorEntityFactory $connectorEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\ConnectorControlEntityFactory */
	private MetadataEntities\Modules\DevicesModule\ConnectorControlEntityFactory $connectorControlEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\ConnectorPropertyEntityFactory */
	private MetadataEntities\Modules\DevicesModule\ConnectorPropertyEntityFactory $connectorPropertyEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\DeviceEntityFactory */
	private MetadataEntities\Modules\DevicesModule\DeviceEntityFactory $deviceEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\DeviceControlEntityFactory */
	private MetadataEntities\Modules\DevicesModule\DeviceControlEntityFactory $deviceControlEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\DevicePropertyEntityFactory */
	private MetadataEntities\Modules\DevicesModule\DevicePropertyEntityFactory $devicePropertyEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\DeviceAttributeEntityFactory */
	private MetadataEntities\Modules\DevicesModule\DeviceAttributeEntityFactory $deviceAttributeEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\ChannelEntityFactory */
	private MetadataEntities\Modules\DevicesModule\ChannelEntityFactory $channelEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\ChannelControlEntityFactory */
	private MetadataEntities\Modules\DevicesModule\ChannelControlEntityFactory $channelControlEntityFactory;

	/** @var MetadataEntities\Modules\DevicesModule\ChannelPropertyEntityFactory */
	private MetadataEntities\Modules\DevicesModule\ChannelPropertyEntityFactory $channelPropertyEntityFactory;

	public function __construct(
		MetadataEntities\Actions\ActionConnectorControlEntityFactory $actionConnectorControlEntityFactory,
		MetadataEntities\Actions\ActionConnectorPropertyEntityFactory $actionConnectorPropertyEntityFactory,
		MetadataEntities\Actions\ActionDeviceControlEntityFactory $actionDeviceControlEntityFactory,
		MetadataEntities\Actions\ActionDevicePropertyEntityFactory $actionDevicePropertyEntityFactory,
		MetadataEntities\Actions\ActionChannelControlEntityFactory $actionChannelControlEntityFactory,
		MetadataEntities\Actions\ActionChannelPropertyEntityFactory $actionChannelPropertyEntityFactory,
		MetadataEntities\Actions\ActionTriggerControlEntityFactory $actionTriggerControlEntityFactory,
		MetadataEntities\Modules\AccountsModule\AccountEntityFactory $accountEntityFactory,
		MetadataEntities\Modules\AccountsModule\EmailEntityFactory $emailEntityFactory,
		MetadataEntities\Modules\AccountsModule\IdentityEntityFactory $identityEntityFactory,
		MetadataEntities\Modules\AccountsModule\RoleEntityFactory $roleEntityFactory,
		MetadataEntities\Modules\TriggersModule\ActionEntityFactory $triggerActionEntityFactory,
		MetadataEntities\Modules\TriggersModule\ConditionEntityFactory $triggerConditionEntityFactory,
		MetadataEntities\Modules\TriggersModule\NotificationEntityFactory $triggerNotificationEntityFactory,
		MetadataEntities\Modules\TriggersModule\TriggerControlEntityFactory $triggerControlEntityFactory,
		MetadataEntities\Modules\TriggersModule\TriggerEntityFactory $triggerEntityFactory,
		MetadataEntities\Modules\DevicesModule\ConnectorEntityFactory $connectorEntityFactory,
		MetadataEntities\Modules\DevicesModule\ConnectorControlEntityFactory $connectorControlEntityFactory,
		MetadataEntities\Modules\DevicesModule\ConnectorPropertyEntityFactory $connectorPropertyEntityFactory,
		MetadataEntities\Modules\DevicesModule\DeviceEntityFactory $deviceEntityFactory,
		MetadataEntities\Modules\DevicesModule\DeviceControlEntityFactory $deviceControlEntityFactory,
		MetadataEntities\Modules\DevicesModule\DevicePropertyEntityFactory $devicePropertyEntityFactory,
		MetadataEntities\Modules\DevicesModule\DeviceAttributeEntityFactory $deviceAttributeEntityFactory,
		MetadataEntities\Modules\DevicesModule\ChannelEntityFactory $channelEntityFactory,
		MetadataEntities\Modules\DevicesModule\ChannelControlEntityFactory $channelControlEntityFactory,
		MetadataEntities\Modules\DevicesModule\ChannelPropertyEntityFactory $channelPropertyEntityFactory
	) {
		$this->actionConnectorControlEntityFactory = $actionConnectorControlEntityFactory;
		$this->actionConnectorPropertyEntityFactory = $actionConnectorPropertyEntityFactory;
		$this->actionDeviceControlEntityFactory = $actionDeviceControlEntityFactory;
		$this->actionDevicePropertyEntityFactory = $actionDevicePropertyEntityFactory;
		$this->actionChannelControlEntityFactory = $actionChannelControlEntityFactory;
		$this->actionChannelPropertyEntityFactory = $actionChannelPropertyEntityFactory;
		$this->actionTriggerControlEntityFactory = $actionTriggerControlEntityFactory;

		$this->accountEntityFactory = $accountEntityFactory;
		$this->emailEntityFactory = $emailEntityFactory;
		$this->identityEntityFactory = $identityEntityFactory;
		$this->roleEntityFactory = $roleEntityFactory;

		$this->triggerActionEntityFactory = $triggerActionEntityFactory;
		$this->triggerConditionEntityFactory = $triggerConditionEntityFactory;
		$this->triggerNotificationEntityFactory = $triggerNotificationEntityFactory;
		$this->triggerControlEntityFactory = $triggerControlEntityFactory;
		$this->triggerEntityFactory = $triggerEntityFactory;

		$this->connectorEntityFactory = $connectorEntityFactory;
		$this->connectorControlEntityFactory = $connectorControlEntityFactory;
		$this->connectorPropertyEntityFactory = $connectorPropertyEntityFactory;
		$this->deviceEntityFactory = $deviceEntityFactory;
		$this->deviceControlEntityFactory = $deviceControlEntityFactory;
		$this->devicePropertyEntityFactory = $devicePropertyEntityFactory;
		$this->deviceAttributeEntityFactory = $deviceAttributeEntityFactory;
		$this->channelEntityFactory = $channelEntityFactory;
		$this->channelControlEntityFactory = $channelControlEntityFactory;
		$this->channelPropertyEntityFactory = $channelPropertyEntityFactory;
	}

	/**
	 * @param string $data
	 * @param MetadataTypes\RoutingKeyType $routingKey
	 *
	 * @return MetadataEntities\IEntity
	 *
	 * @throws MetadataExceptions\FileNotFoundException
	 */
	public function create(string $data, MetadataTypes\RoutingKeyType $routingKey): MetadataEntities\IEntity
	{
		// ACTIONS
		if ($routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_CONTROL_ACTION)) {
			return $this->actionConnectorControlEntityFactory->create($data);

		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_PROPERTY_ACTION)) {
			return $this->actionConnectorPropertyEntityFactory->create($data);

		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_CONTROL_ACTION)) {
			return $this->actionDeviceControlEntityFactory->create($data);

		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_PROPERTY_ACTION)) {
			return $this->actionDevicePropertyEntityFactory->create($data);

		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_CONTROL_ACTION)) {
			return $this->actionChannelControlEntityFactory->create($data);

		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_PROPERTY_ACTION)) {
			return $this->actionChannelPropertyEntityFactory->create($data);

		} elseif ($routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONTROL_ACTION)) {
			return $this->actionTriggerControlEntityFactory->create($data);

		// ACCOUNTS MODULE
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ACCOUNT_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ACCOUNT_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ACCOUNT_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ACCOUNT_ENTITY_DELETED)
		) {
			return $this->accountEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_EMAIL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_EMAIL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_EMAIL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_EMAIL_ENTITY_DELETED)
		) {
			return $this->emailEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_IDENTITY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_IDENTITY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_IDENTITY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_IDENTITY_ENTITY_DELETED)
		) {
			return $this->identityEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ROLE_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ROLE_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ROLE_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_ROLE_ENTITY_DELETED)
		) {
			return $this->roleEntityFactory->create($data);

		// DEVICES MODULE
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ENTITY_DELETED)
		) {
			return $this->deviceEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_PROPERTY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_PROPERTY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_PROPERTY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_PROPERTY_ENTITY_DELETED)
		) {
			return $this->devicePropertyEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_CONTROL_ENTITY_DELETED)
		) {
			return $this->deviceControlEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ATTRIBUTE_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ATTRIBUTE_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ATTRIBUTE_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_DEVICE_ATTRIBUTE_ENTITY_DELETED)
		) {
			return $this->deviceAttributeEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_ENTITY_DELETED)
		) {
			return $this->channelEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_PROPERTY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_PROPERTY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_PROPERTY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_PROPERTY_ENTITY_DELETED)
		) {
			return $this->channelPropertyEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CHANNEL_CONTROL_ENTITY_DELETED)
		) {
			return $this->channelControlEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_ENTITY_DELETED)
		) {
			return $this->connectorEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_PROPERTY_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_PROPERTY_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_PROPERTY_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_PROPERTY_ENTITY_DELETED)
		) {
			return $this->connectorPropertyEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_CONNECTOR_CONTROL_ENTITY_DELETED)
		) {
			return $this->connectorControlEntityFactory->create($data);

		// TRIGGERS MODULE
		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ENTITY_DELETED)
		) {
			return $this->triggerEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONTROL_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONTROL_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONTROL_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONTROL_ENTITY_DELETED)
		) {
			return $this->triggerControlEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ACTION_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ACTION_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ACTION_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_ACTION_ENTITY_DELETED)
		) {
			return $this->triggerActionEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_NOTIFICATION_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_NOTIFICATION_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_NOTIFICATION_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_NOTIFICATION_ENTITY_DELETED)
		) {
			return $this->triggerNotificationEntityFactory->create($data);

		} elseif (
			$routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONDITION_ENTITY_REPORTED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONDITION_ENTITY_CREATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONDITION_ENTITY_UPDATED)
			|| $routingKey->equalsValue(MetadataTypes\RoutingKeyType::ROUTE_TRIGGER_CONDITION_ENTITY_DELETED)
		) {
			return $this->triggerConditionEntityFactory->create($data);
		}

		throw new Exceptions\InvalidStateException('Entity could not be created');
	}

}
