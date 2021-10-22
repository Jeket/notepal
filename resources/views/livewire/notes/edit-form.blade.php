<div class="grid grid-cols-2 gap-x-12">
    <div id="form">
        {{ $this->form }}
    </div>

    <div id="preview" class="bg-white rounded-lg border border-gray-300 prose prose-indigo p-8">
        {!! $note->rendered_content !!}
    </div>
</div>
