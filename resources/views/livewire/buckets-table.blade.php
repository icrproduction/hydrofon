<div>
    <table class="table">
        @include('livewire.partials.table-header')

        <tbody>
            @forelse($items as $item)
                @if($this->isEditing === $item->id)
                    <tr class="{{ $loop->odd ? 'odd' : 'even' }} is-editing">
                        <td data-title="&nbsp;">&nbsp;</td>
                        <td data-title="Name">
                            <input
                                type="text"
                                name="name"
                                value="{{ $item->name }}"
                                class="field"
                                wire:model.debounce.500ms="editValues.name"
                            />

                            @error('editValues.name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </td>
                        <td data-title="&nbsp;" class="text-right">
                            <x-forms.button
                                type="link"
                                wire:click.prevent="$emit('save')"
                                wire:loading.attr="disabled"
                            >Save</x-forms.button>

                            <x-forms.button-secondary
                                type="link"
                                wire:click.prevent="$set('isEditing', false)"
                            >Cancel</x-forms.button-secondary>
                        </td>
                    </tr>
                @else
                    <tr class="{{ $loop->odd ? 'odd' : 'even' }} hover:bg-brand-100">
                        <td data-title="&nbsp;">
                            <input
                                type="checkbox"
                                value="{{ $item->id }}"
                                {{ in_array($item->id, $this->selectedRows) ? 'checked="checked"' : '' }}
                                wire:click="$emit('select', {{ $item->id }}, $event.target.checked)"
                            />
                        </td>
                        <td data-title="Name">
                            <a href="{{ route('buckets.edit', $item) }}">{{ $item->name }}</a>
                        </td>
                        <td data-title="&nbsp;" class="table-actions">
                            <div>
                                <a
                                    href="{{ route('buckets.edit', $item) }}"
                                    title="Edit"
                                    wire:click.prevent="$emit('edit', {{ $item->id }})"
                                >Edit</a>
                            </div>

                            <div>
                                {!! Form::model($item, ['route' => ['buckets.destroy', $item->id], 'method' => 'DELETE' ]) !!}
                                    <button
                                        type="submit"
                                        title="Delete"
                                        wire:click.prevent="$emit('delete', {{ $item->id }})"
                                        wire:loading.attr="disabled"
                                    >Delete</button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="{{ count($this->tableHeaders) + 2 }}">No buckets was found.</td>
                </tr>
            @endforelse
        </tbody>

        <tfoot>
            <tr>
                <th colspan="{{ count($this->tableHeaders) + 2 }}">
                    <div class="flex justify-end">
                        <form>
                            <x-forms.button-link
                                :disabled="count($this->selectedRows) === 0"
                                wire:click.prevent="$emit('delete', false, true)"
                            >Delete</x-forms.button-link>
                        </form>
                    </div>
                </th>
            </tr>
        </tfoot>
    </table>
</div>

@include('livewire.partials.table-scripts')
