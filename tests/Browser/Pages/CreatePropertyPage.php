<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class CreatePropertyPage extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return route('finca.create');
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
//        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@name' => "name",
//            '@geolocation' => 'input[name=geolocation]',
//            '@fiscal' => 'input[name=fiscal]',
//            '@nofiscal' => 'input[name=nofiscal]',
//            '@mantenimiento' => 'input[name=mantenimiento]',
//            '@water_fee' => 'input[name=water_fee]',
//            '@energy_fee' => 'input[name=energy_fee]',
//            '@water_account_number' => 'input[name=water_account_number]',
//            '@predial' => 'input[name=predial]',
//            '@save' => '#verificar',
            '@lessor_modal' => '#lessor_modal'
        ];
    }

    public function selectLessor(Browser $browser, $id): void
    {
        $browser->click('@lessor_modal');
        $browser->pause(500);
        $browser->assertSee('Seleccione el Arrendador');
        $browser->click("button[id=arrendadorse$id]"); // @todo refactor name id

        $browser->waitUntilMissingText('Seleccione el Arrendador',15);
    }
}
