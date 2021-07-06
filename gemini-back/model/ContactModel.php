<?php


class ContactModel
{

    private $id;
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $email;
    private $telephone;
    private $contactTypeId;

    /**
     * ContactModel constructor.
     * @param $id
     * @param $firstName
     * @param $lastName
     * @param $dateOfBirth
     * @param $email
     * @param $telephone
     * @param $contactTypeId
     */
    public function __construct($firstName, $lastName, $dateOfBirth, $email, $telephone, $contactTypeId, $id = null)
    {
        if($id){
            $this->id = $id;
        }
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->setEmail($email);
        $this->telephone = $telephone;
        $this->contactTypeId = $contactTypeId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getContactTypeId()
    {
        return $this->contactTypeId;
    }

    /**
     * @param mixed $contactTypeId
     */
    public function setContactTypeId($contactTypeId)
    {
        $this->contactTypeId = $contactTypeId;
    }
}
