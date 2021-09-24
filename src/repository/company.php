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
       $email_contable = $company->getEmailContable();
       //$findCompany = $this->getCompanyDocumentNumber($document);

      // if(count($findCompany) == 0){
           $sql="INSERT INTO company (name,document_number,id_document_type,address , activity ,  billing ,  id_county ,  participants_number ,  total, email_contable ) 
                       VALUES('$name','$document','$documentType','$address','$activity','$billing','$id_country',$participantsNumber, '$total', '$email_contable')";
           try {
              // echo json_encode($sql);
               $this->db->executeInstruction($sql);
               return ["error" => "false", "message"=>"Se registro la empresa exitosamente!"];
           }catch (Exception $e){
               return ["error" => "true", "message"=>"Error al guardar la empresa!"];
           }
      // }else{
        //   return ["error" => "true", "message"=>"Error ya se encuentra registrado este RUC."];
      // }

    }

    public function updateCompany(CompanyDTO $company) {
        $name=$company->getName();
       $address=$company->getAddress();
       $participantsNumber = $company->getParticipantsNumber();
       $document = $company->getDocumentNumber();
       $activity = $company->getActivity();
       $id_country = $company->getIdCountry();
       $total = $company->getTotal();
       $id = $company->getId();
       $billing = $company->getBilling();
       $email_contable = $company->getEmailContable();
        $sql = "UPDATE company t SET t.address = '$address', t.activity = '$activity', 
        t.name ='$name', t.document_number= '$document', t.billing='$billing', t.id_county='$id_country',
         t.participants_number='$participantsNumber', total= '$total', email_contable='$email_contable'  WHERE t.id = '$id'";
        try {
            // echo json_encode($sql);
            $this->db->executeInstruction($sql);
            return ["error" => "false", "message"=>"Se actualizo la empresa exitosamente!"];
        } catch (Exception $e) {
            return ["error" => "true", "message"=>"Error al Actualizar la empresa!"];
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

    public function getCompanyUpdate($document_number,$type) {
        $sql="SELECT * FROM company where document_number ='$document_number' AND  id_document_type='$type'";
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

    public function getPerson($id, $person_type) {
        $sql="";
        if($id == null) {
            $sql="SELECT p.name,p.last_name,p.document_number,p.email,p.phone_number,p.city, p.position,p.guest, p.company_name, p.id FROM person p where p.id_person_type = 2 OR p.id_person_type = 3";
        }
        else {
            $sql="SELECT p.name,p.last_name,p.document_number,p.email,p.phone_number,p.city, p.position,p.guest, p.company_name, p.id FROM person p, company_person_rel rel where rel.id_company ='$id' and rel.id_person = p.id  and p.id_person_type = ".$person_type;

        }
        
        //echo $sql. "---";
        $consulta = array();
        try {
            if (isset($this)) {
                $consulta = $this->db->getData($sql);
            }
        } catch (Exception $e) {
            print $e;
        }
        if($consulta){
            return $consulta;
        }
        return [];

    }

    public function getCompanyId($id) {
        $sql="SELECT * FROM company where id ='$id'";
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
