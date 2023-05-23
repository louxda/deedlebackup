<?php

namespace App\Orchid\Screens\Challenges;

use App\Models\DailyChallenge;
use App\Models\DeedlerChallenge;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ChallengeUpsertScreen extends Screen
{
    protected $name = "Create Deedle";

    protected $deedle;

    private bool $exists;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(DailyChallenge $deedle): iterable
    {
        $this->deedle = $deedle;
        $this->exists = $deedle->exists;
        if ($deedle->exists) {
            $this->name = "Edit Deedle";
        }
        return [
            "deedle" => $deedle,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Create'))
                  ->icon('check')
//                  ->confirm('You can revert to your original state by logging out.')
                  ->method('createOrUpdate')
                  ->canSee(!$this->exists),

            Button::make(__('Remove'))
                  ->icon('trash')
                  ->confirm("Are you sure you want to remove this deedle?")
                  ->method('remove')
                  ->canSee($this->exists),

            Button::make("Update")
                  ->icon('check')
                  ->confirm("Are you sure you want to update this deedle?")
                  ->method('createOrUpdate')
                  ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [ Layout::rows([
            Input::make("deedle.title")
                 ->title("Title")
                 ->required(),
            Input::make("deedle.challenge_number")
                 ->title("Number")
                 ->required(),
            DateTimer::make("deedle.dated_for")
                     ->title("Dated For")
                     ->required()
                     ->enableTime(false)
                     ->format("Y-m-d"),
        ]) ];
    }

    public function createOrUpdate(DailyChallenge $deedle, Request $request)
    {
        $request->validate([
            "deedle.dated_for" => "required",
            "deedle.title"     => "required",
            "deedle.challenge_number"     => "required",
        ]);
        $exists = $deedle->exists;
        $saved = $deedle->fill($request->get("deedle"))->save();
        if ($saved) {
            if ($exists) {
                Toast::success("Deedle has been updated.");
            } else {
                Toast::success("Deedle has been created.");
            }
            return redirect()->route('platform.manage.deedles.edit', $deedle);
        }
        Toast::error("Couldn't save deedle.");
        return redirect()->route('platform.manage.deedles.edit');
    }

    public function remove(DailyChallenge $deedle)
    {
        $deedle->delete();
        DeedlerChallenge::query()->where("challenge_id","=",$deedle->id)->delete();
        Toast::success("Deedle has been deleted.");
        return redirect()->route('platform.manage.deedles.list');
    }
}
