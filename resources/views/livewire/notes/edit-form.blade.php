<section>
    <x-slot name="header">
        <div x-data="{
            title: {{ json_encode($note->title) }},
            state: 'viewing',
            init() {
                this.$watch('title', () => {
                    this.$dispatch('edit-form:save-title', this.title)
                    this.state = 'viewing'
                })
            }
        }">
            <h2 x-text="title" class="font-semibold text-xl text-gray-800 leading-tight cursor-pointer" x-on:click.prevent="state = 'editing'" x-show="state === 'viewing'">
                {{ $note->title }}
            </h2>

            <x-input type="text" x-show="state === 'editing'" class="w-1/2" x-model.lazy="title" x-cloak />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-x-12">
                <div id="form">
                    {{ $this->form }}
                </div>

                <div id="preview" class="bg-white rounded-lg border border-gray-300 prose prose-indigo p-8">
                    {!! $note->rendered_content !!}
                </div>
            </div>

            <div x-data x-on:edit-form:save-title.window="$wire.setNoteTitle($event.detail)"></div>
        </div>
    </div>
</section>
