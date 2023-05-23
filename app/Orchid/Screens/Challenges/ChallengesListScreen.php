<?php

namespace App\Orchid\Screens\Challenges;

use App\Models\DailyChallenge;
use App\Models\DeedlerChallenge;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ChallengesListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            "deedles" => DailyChallenge::filters()->defaultSort('dated_for')->paginate(50),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Deedles List';
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
//            ModalToggle::make('Upload CSV')
//                       ->modal('csvUploadModal')->method("csvUpload")
//                       ->icon('cloud-upload'),
            Link::make(__('Create'))
                ->icon('plus')
                ->route('platform.manage.deedles.edit'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table("deedles", [
                TD::make('id')->filter(TD::FILTER_NUMERIC)->sort(),
                TD::make("title")->filter(TD::FILTER_TEXT)->sort(),
                TD::make('dated_for', 'Dated For')
                  ->filter(TD::FILTER_DATE)
                  ->render(function($model) {
                      return Carbon::parse($model->dated_for)->format("m-d-Y");
                  }),
                TD::make('challenge_number', 'Number')
                  ->filter(TD::FILTER_NUMERIC),
                TD::make('created_at', 'Date Created')
                  ->filter(TD::FILTER_DATE)
                  ->render(function($model) {
                      return $model->created_at->toDateTimeString();
                  }),
                TD::make('updated_at', 'Date Updated')
                  ->filter(TD::FILTER_DATE)
                  ->render(function($model) {
                      return $model->updated_at->toDateTimeString();
                  }),
                TD::make(__('Actions'))
                  ->align(TD::ALIGN_CENTER)
                  ->width('100px')
                  ->render(function(DailyChallenge $deedle) {
                      return DropDown::make()
                                     ->icon('options-vertical')
                                     ->list([
                                         Link::make(__('Edit'))
                                             ->route('platform.manage.deedles.edit', $deedle->id)
                                             ->icon('pencil'),
                                         Button::make(__('Remove'))
                                               ->icon('trash')
                                               ->method('remove')
                                               ->confirm(__('Are you sure you want to remove this topic?'))
                                               ->parameters([
                                                   'id' => $deedle->id,
                                               ]),
                                     ]);
                  }),
            ]),
        ];
    }

    public function remove(Request $request)
    {
        $topic = DailyChallenge::query()->find($request->get("id"));
        $topic->delete();
        DeedlerChallenge::query()->where("challenge_id", "=", $request->get("id"))->delete();
        Toast::success("Topic has been deleted.");
    }
}
