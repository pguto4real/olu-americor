<?php

namespace app\models\traits;

use app\models\Call;
use app\models\Customer;
use app\models\Fax;
use app\models\Sms;
use app\models\Task;
use app\models\User;

trait ObjectNameTrait
{
    public static $classes = [
        Customer::class,
        Sms::class,
        Task::class,
        Call::class,
        Fax::class,
        User::class,
    ];

    /**
     * Retrieves the relation object based on the provided name.
     *
     * @param string $name The name of the relation
     * @param bool $throwException Whether to throw an exception if the relation is not found
     * @return \yii\db\ActiveQueryInterface|null The relation object, or null if not found and $throwException is false
     * @throws \yii\base\InvalidConfigException If the relation cannot be determined
     */
    public function getRelation($name, $throwException = true)
    {
        // Validate the relation name
        if (!is_string($name) || empty($name)) {
            if ($throwException) {
                throw new \InvalidArgumentException("Invalid relation name provided: $name");
            } else {
                return null;
            }
        }
        // Construct the method name for the relation getter
        $getter = 'get' . $name;

        // Determine the class associated with the provided relation name
        $class = self::getClassNameByRelation($name);

        /// If the method doesn't exist and a valid class is found, return a hasOne relation
        if (!method_exists($this, $getter) && $class) {
            try {
                return $this->hasOne($class, ['id' => 'object_id']);
            } catch (\Throwable $e) {
                if ($throwException) {
                    throw new \yii\base\InvalidConfigException("Error creating relation '$name': " . $e->getMessage());
                } else {
                    return null;
                }
            }
        }

        // If the method exists or no valid class is found, fall back to the parent class's getRelation method
        return parent::getRelation($name, $throwException);
    }
    /**
     * Gets the table name associated with the given class name.
     *
     * @param string|object $class The class name or an object
     * @return string|null The table name or null if not found
     * @throws InvalidArgumentException If the provided class does not exist or does not have a tableName() method
     */
    public static function getTableNameFromClass($class)
    {
        if (is_object($class)) {
            $className = get_class($class);
        } elseif (is_string($class) && class_exists($class)) {
            $className = $class;
        } else {
            throw new InvalidArgumentException("Invalid class provided: $class");
        }

        if (method_exists($className, 'tableName')) {
            try {
                return str_replace(['{', '}', '%'], '', $className::tableName());
            } catch (Throwable $e) {
                throw new InvalidArgumentException("Error getting table name for class $className: " . $e->getMessage());
            }
        }

        return null;
    }

    /**
     * Retrieves the class name associated with the provided relation name.
     *
     * @param string $relation The name of the relation
     * @return string|null The class name, or null if not found
     */
    public static function getClassNameByRelation($relation)
    {
        // Iterate over the classes to find a match for the provided relation name
        foreach (self::$classes as $class) {
            // Retrieve the table name associated with the class
            $tableName = self::getTableNameFromClass($class);

            // If the table name matches the provided relation name, return the class name
            if ($tableName === $relation) {
                return $class;
            }
        }

        // If no match is found, return null
        return null;
    }
}