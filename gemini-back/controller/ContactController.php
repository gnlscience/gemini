<?php
require_once(__DIR__.'/../service/ContactService.php');
require_once(__DIR__.'/CoreController.php');

class ContactController extends CoreController
{
    public function __construct(){
        $this->contactService = new ContactService();
    }

    function _get(){
        $this->load_view('home', []);
    }

    //http://localhost:8085/index.php/Contact/getAll/
    function getAll_get($start = 0, $size = 10){
        $contacts = $this->contactService->findMany($start, $size);

        $result = [];
        /** @var ContactModel $contact */
        foreach($contacts as $contact){
            $result[] = [
                'id' => $contact->getId(),
                'firstName' => $contact->getFirstName(),
                'lastName' => $contact->getLastName(),
                'dateOfBirth' => $contact->getDateOfBirth(),
                'email' => $contact->getEmail(),
                'telephone' => $contact->getTelephone(),
                'contactTypeId' => $contact->getContactTypeId(),
            ];
        }
        echo json_encode($result);
    }

    //http://localhost:8085/index.php/Contact/get/2/
    function get_get($id){
        $contact = $this->contactService->findOne($id);
        echo json_encode([
            'id' => $contact->getId(),
            'firstName' => $contact->getFirstName(),
            'lastName' => $contact->getLastName(),
            'dateOfBirth' => $contact->getDateOfBirth(),
            'email' => $contact->getEmail(),
            'telephone' => $contact->getTelephone(),
            'contactTypeId' => $contact->getContactTypeId(),
        ]);
    }


    //http://localhost/:8085/index.php/Contact/create/
    function create_post(){
        $postData = json_decode(file_get_contents("php://input"), true);
        $contact = $this->contactService->create(
            $postData['firstName'],
            $postData['lastName'],
            $postData['dateOfBirth'],
            $postData['email'],
            $postData['telephone'],
            $postData['contactTypeId']);
        echo json_encode([
            'id' => $contact->getId(),
            'firstName' => $contact->getFirstName(),
            'lastName' => $contact->getLastName(),
            'dateOfBirth' => $contact->getDateOfBirth(),
            'email' => $contact->getEmail(),
            'telephone' => $contact->getTelephone(),
            'contactTypeId' => $contact->getContactTypeId(),
        ]);
    }

    //http://localhost:8085/index.php/Contact/update/
    function update_post(){
        $postData = json_decode(file_get_contents("php://input"), true);
        $contact = $this->contactService->update($postData['id'], $postData['firstName'], $postData['lastName'], $postData['dateOfBirth'], $postData['email'], $postData['telephone'], $postData['contactTypeId']);
        echo json_encode([
            'id' => $contact->getId(),
            'firstName' => $contact->getFirstName(),
            'lastName' => $contact->getLastName(),
            'dateOfBirth' => $contact->getDateOfBirth(),
            'email' => $contact->getEmail(),
            'telephone' => $contact->getTelephone(),
            'contactTypeId' => $contact->getContactTypeId(),
        ]);
    }

    //http://localhost:8085/index.php/Contact/delete/{$id}
    function delete_post($id){
        $this->contactService->delete($id);
        return json_encode([
            'result' => true,
        ]);
    }
}
