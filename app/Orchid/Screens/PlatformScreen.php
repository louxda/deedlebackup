<?php

declare( strict_types = 1 );

namespace App\Orchid\Screens;

use App\Models\Deedler;
use App\Models\DeedlerChallenge;
use App\Orchid\Layouts\Dashboard\DeedlesDonePerDayBarChart;
use App\Orchid\Layouts\Dashboard\NewUsersPerDay;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            "deedleSet" => [
                DeedlerChallenge::countByDays(null, null, 'created_at')->toChart('Deedles Count'),
            ],
            "userSet"   => [
                Deedler::countByDays(null, null, 'created_at')->toChart('Users'),
            ],
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Get Started';
    }

    /**
     * Display header description.
     *
     * @return string|null
     */
    public function description(): ?string
    {
        return 'Welcome to your Deedle admin panel.';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
//            Link::make('Website')
//                ->href('http://orchid.software')
//                ->icon('globe-alt'),
//
//            Link::make('Documentation')
//                ->href('https://orchid.software/en/docs')
//                ->icon('docs'),
//
//            Link::make('GitHub')
//                ->href('https://github.com/orchidsoftware/platform')
//                ->icon('social-github'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
//            Layout::view('platform::partials.welcome'),
            DeedlesDonePerDayBarChart::class,
            NewUsersPerDay::class,
        ];
    }
}
