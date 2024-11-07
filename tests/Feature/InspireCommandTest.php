<?php

it('billing', function () {
    $this->artisan('billing')->assertExitCode(0);
});
