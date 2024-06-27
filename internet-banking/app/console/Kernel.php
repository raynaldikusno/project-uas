protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        app(DepositoController::class)->transferMaturedDeposits();
    })->hourly();
}
