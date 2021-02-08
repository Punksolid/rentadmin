<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class CreateContractPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/contrato/create';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
            '@lessor_modal' => '#lessor_modal',
            '@property_modal' => '#property_modal',
            '@lessee_modal' => '#lessee_modal',
            '@years' => 'input[name=duracion_contrato]',
            '@bonus' => 'input[name=bonificacion]',
            '@deposit' => 'input[name=deposito]',
            '@submit' => 'button[type=submit]',
        ];
    }

    public function fillAllForm(Browser $browser, array $fields)
    {
//        $browser->type('name', $name)
//            ->check('share')
//            ->press('Create Playlist');
    }

    public function selectLessor(Browser $browser, $id)
    {
        $browser->click('@lessor_modal');
        $browser->pause(500);
        $browser->assertSee('Seleccione el Arrendador');
        $browser->click("button[id=arrendador_contrato$id]");

        $browser->waitUntilMissingText('Seleccione el Arrendador',15);
    }

    public function selectProperty(Browser $browser, $id)
    {
        $browser->click('@property_modal');
        $browser->pause(500);
        $browser->click("button[id=propiedad_modal$id]");

        $browser->waitUntilMissingText('Seleccione La Propiedad',15);
    }

    public function selectLessee(Browser $browser, $id)
    {
        $browser->click('@lessee_modal');
        $browser->pause(500);
        $browser->click("button[id=arrendatario_contrato$id]");

        $browser->waitUntilMissingText('Seleccione el Arrendatario',10);
    }
}
