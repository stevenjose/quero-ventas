<?php

class PersonDTO
{
    private $id;
    private $name;
    private $last_name;
    private $email;
    private $city;
    private $document_number;
    private $phone_number;
    private $id_document_type;
    private $column_9;
    private $company_name;
    private $id_person_type;
    private $total;

    /**
     * @return mixed
     */
    public function getId(): int
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     */
    public function setLastName(string $last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getDocumentNumber(): int
    {
        return $this->document_number;
    }

    /**
     * @param mixed $document_number
     */
    public function setDocumentNumber(int $document_number)
    {
        $this->document_number = $document_number;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumer(): int
    {
        return $this->phone_numer;
    }

    /**
     * @param mixed $phone_numer
     */
    public function setPhoneNumer(int $phone_numer)
    {
        $this->phone_numer = $phone_numer;
    }

    /**
     * @return mixed
     */
    public function getIdDocumentType()
    {
        return $this->id_document_type;
    }

    /**
     * @param mixed $id_document_type
     */
    public function setIdDocumentType($id_document_type)
    {
        $this->id_document_type = $id_document_type;
    }

    /**
     * @return mixed
     */
    public function getColumn9()
    {
        return $this->column_9;
    }

    /**
     * @param mixed $column_9
     */
    public function setColumn9($column_9)
    {
        $this->column_9 = $column_9;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->company_name;
    }

    /**
     * @param mixed $company_name
     */
    public function setCompanyName($company_name)
    {
        $this->company_name = $company_name;
    }

    /**
     * @return mixed
     */
    public function getIdPersonType()
    {
        return $this->id_person_type;
    }

    /**
     * @param mixed $id_person_type
     */
    public function setIdPersonType($id_person_type)
    {
        $this->id_person_type = $id_person_type;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }


    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

}