<?php

namespace App\Http\Livewire\Notes;

use App\Models\Note;
use App\Support\Markdown\Markdown;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class EditForm extends Component implements HasForms
{
    use InteractsWithForms;

    public Note $note;

    protected function getFormSchema(): array
    {
        return [

            MarkdownEditor::make('note.content')
                ->disableLabel()
                ->disableToolbarButtons(['attachFiles', 'preview', 'edit'])
                ->nullable()
                ->lazy(),

        ];
    }

    public function getPreviewProperty()
    {
        $markdown = new Markdown;

        return $markdown->convert($this->note->content);
    }

    public function updatedNoteContent()
    {
        $this->validateOnly('note.content');
        $this->note->save();
    }

    public function render()
    {
        return view('livewire.notes.edit-form');
    }
}
