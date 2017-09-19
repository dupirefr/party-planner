<?php

namespace Tests\UserBundle\Entity;

use DateTime;
use PartyPlanner\UserBundle\Entity\User;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Test class for User
 *
 * @author dupirefr
 */
class UserTest extends TestCase
{
	/*
	 * Fields
	 */
	/**
	 * @var ValidatorInterface
	 */
	private $validator;

	/*
	 * Setups
	 */
	public function setUp()
	{
		$this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
	}

	/*
	 * Tests
	 */
	public function testUser_Valid()
	{
		$user = new User();
		$user->setFirstName('John');
		$user->setLastName('Doe');
		$user->setEmail('john.doe@gmail.com');
		$user->setBirthDate(new DateTime());
		$user->setPassword('P@ssw0rd');

		$errors = $this->validator->validate($user);

		$this->assertEquals(0, count($errors));
	}
}
