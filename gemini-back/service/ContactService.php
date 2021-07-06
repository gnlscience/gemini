<?php
require_once(__DIR__.'/../model/ContactModel.php');
require_once(__DIR__.'/../repository/ContactRepository.php');



class ContactService
{
    private $contactRepository;

    /**
     * ContactService constructor.
     */
    public function __construct()
    {
        $this->contactRepository = new ContactRepository();
    }

    function create($firstName, $lastName, $dateOfBirth, $email, $telephone, $contact_type_id){
        $newContact = new ContactModel($firstName, $lastName, $dateOfBirth, $email, $telephone, $contact_type_id);
        $last_id = $this->contactRepository->create($newContact);
        if($last_id){
            $newContact->setId($last_id);
        }

        return $newContact;
    }

    function update($id, $firstName, $lastName, $dateOfBirth, $email, $telephone, $contact_type_id){
        $newContact = new ContactModel($firstName, $lastName, $dateOfBirth, $email, $telephone, $contact_type_id, $id);
        $this->contactRepository->update($newContact);
        return $newContact;
    }

    function findOne($id){
        $dataArray = $this->contactRepository->findOne($id);
        return new ContactModel($dataArray['first_name'], $dataArray['last_name'], $dataArray['date_of_birth'], $dataArray['email'], $dataArray['telephoone'], $dataArray['contact_type_id'], $dataArray['id']);
    }

    function delete($id){
        $contact = $this->findOne($id);
        $this->contactRepository->delete($contact);
    }

    function findMany($start = 0, $size = 10){
        $dataArrays = $this->contactRepository->findMany($start, $size);
        $contacts = [];
        foreach($dataArrays as $dataArray){
            $contacts[] = new ContactModel($dataArray['first_name'], $dataArray['last_name'], $dataArray['date_of_birth'], $dataArray['email'], $dataArray['tel'], $dataArray['contact_type_id'], $dataArray['id']);
        }
        return $contacts;
    }
}
