
<?php


use App\Services\ServiceCaminhoes;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class TesteUm extends TestCase{

    private $serviceCaminhao;

    protected function setUp(): void
    {
        $this->serviceCaminhao =  new ServiceCaminhoes ();
    }

    public function primeiro()
    {
       
        $this->serviceCaminhao->listar($id=null);

    }




}