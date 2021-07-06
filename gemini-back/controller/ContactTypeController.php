<?php
require_once(__DIR__.'/../service/ContactTypeService.php');
require_once(__DIR__.'/CoreController.php');

class ContactTypeController extends CoreController
{
    private $contactTypeService;

    public function __construct(){
        $this->contactTypeService = new ContactTypeService();
    }

    function _get(){
        echo "Hello, World!";
    }

    //http://localhost:8085/index.php/contactType/getAll/
    function getAll_get(){
        $contactTypes = $this->contactTypeService->findMany();

        $result = [];
        /** @var ContactTypeModel $contact */
        foreach($contactTypes as $contactType){
            $result[] = [
                'id' => $contactType->getId(),
                'name' => $contactType->getName(),
            ];
        }
        echo json_encode($result);
    }
}
