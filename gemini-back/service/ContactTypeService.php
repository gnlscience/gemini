<?php
require_once(__DIR__.'/../model/ContactTypeModel.php');
require_once(__DIR__.'/../repository/ContactTypeRepository.php');



class ContactTypeService
{
    private $contactTypeRepository;

    /**
     * ContactService constructor.
     */
    public function __construct()
    {
        $this->contactTypeRepository = new ContactTypeRepository();
    }

    function findOne($id){
        $dataArray = $this->contactTypeRepository->findOne($id);
        return new ContactTypeModel($dataArray['name'], $dataArray['id']);
    }

    function findMany(){
        $dataArrays = $this->contactTypeRepository->findMany();

        $contactTypes = [];
        foreach($dataArrays as $dataArray){
            $contactTypes[] = new ContactTypeModel($dataArray['name'], $dataArray['id']);
        }

        return $contactTypes;
    }
}
