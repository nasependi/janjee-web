<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Field;
use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class AStatsOverview extends BaseWidget
{

  use InteractsWithPageFilters;

  protected function getStats(): array
  {
    $booking = Booking::whereBetween('date', [now()->startOfYear(), now()->endOfYear()])->count();
    $field = Field::count();
    $user = User::count();
    return [
      Stat::make('Pemesanan', $booking)
        ->description('Jumlah pemesanan'),
      Stat::make('Lapangan', $field)
        ->description('Jumlah lapangan'),
      Stat::make('Pengguna', $user)
        ->description('Jumlah pengguna'),
    ];
  }
}
