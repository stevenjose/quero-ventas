<?php
//require __DIR__."/../../db/conexion.php";
require __DIR__."/../dto/CompanyDTO.php";
class Company {

    private $db;

    function __construct() {
        $this->db = new MysqlDB();
        $this->db->connect();
    }

    public function initTransaction() {
       // mysqli_begin_transaction($this->db->getConnect());
    }

    public function commitDB() {
      //  mysqli_commit($this->db->getConnect());
    }

    public function rollBack() {
      //  mysqli_rollback($this->db->getConnect());
    }
    public function postCreateCompany(CompanyDTO $company) {
       // INSERT INTO  company  ( id ,  name ,  document_number ,  id_document_type , 
       // address ,  activity ,  billing ,  id_county ,  participants_number ,  total )
       // VALUES (null,'TPT','777777',2,'PERU','CARNE','2345',1,2,774);
       $name=$company->getName();
       $address=$company->getAddress();
       $participantsNumber = $company->getParticipantsNumber();
       $document = $company->getDocumentNumber();
       $activity = $company->getActivity();
       $id_country = $company->getIdCountry();
       $total = $company->getTotal();
       $documentType = $company->getIdDocumentType();
       $billing = $company->getBilling();

       $findCompany = $this->getCompanyDocumentNumber($document);

       if(count($findCompany) == 0){
           $sql="INSERT INTO company (name,document_number,id_document_type,address , activity ,  billing ,  id_county ,  participants_number ,  total ) 
                       VALUES('$name','$document','$documentType','$address','$activity','$billing','$id_country',$participantsNumber, '$total')";
           try {
               $this->db->executeInstruction($sql);
               return ["error" => "false", "message"=>"Se registro la empresa exitosamente!"];
           }catch (Exception $e){
               return ["error" => "true", "message"=>"Error al guardar la empresa!"];
           }
       }else{
           return ["error" => "true", "message"=>"Error ya se encuentra registrado este RUC."];
       }

    }

    public function postCreateRelCompanyPerson($id_company, $id_person) {
           $sql="INSERT INTO company_person_rel (id_company,id_person) 
                        VALUES('$id_company','$id_person')";
                       
            try {
                $this->db->executeInstruction($sql);
                return ["error" => "false", "message"=>"Se registro la empresa exitosamente!"];
            }catch (Exception $e){
                return ["error" => "true", "message"=>"Error al guardar la empresa!"];
            }
       
 
     }
 

    public function getCompanyDocumentNumber($document_number) {
        $sql="SELECT * FROM company where document_number ='$document_number'";
        //echo $sql. "---";
        $consulta = array();
        try {
            if (isset($this)) {
                $consulta = $this->db->getDataSingle($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        if($consulta){
            return $consulta;
        }
        return [];

    }

  

}
