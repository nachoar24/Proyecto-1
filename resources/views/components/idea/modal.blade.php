@props([
    'idea' => null,
])

@php
    $editing = $idea !== null;

    $modalName = $editing
        ? 'edit-idea'
        : 'create-idea';

    $modalTitle = $editing
        ? 'Editar idea'
        : 'Nueva idea';

    $formAction = $editing
        ? route('ideas.update', $idea, false)
        : route('ideas.store', [], false);

    $formTest = $editing
        ? 'edit-idea-form'
        : 'create-idea-form';

    $submitTest = $editing
        ? 'submit-edit-idea-button'
        : 'submit-create-idea-button';

    $cancelTest = $editing
        ? 'cancel-edit-idea-button'
        : 'cancel-create-idea-button';

    $submitLabel = $editing
        ? 'Actualizar idea'
        : 'Crear idea';

    $titleId = $modalName . '-title';
    $descriptionId = $modalName . '-description';
    $imageId = $modalName . '-image';
    $newStepId = $modalName . '-new-step';
    $newLinkId = $modalName . '-new-link';
    $statusId = $modalName . '-status';

    $initialStatus = old(
        'status',
        $editing
            ? $idea->status->value
            : \App\Enums\IdeaStatus::Pending->value
    );

    $initialSteps = old(
        'steps',
        $editing
            ? $idea->steps->pluck('description')->values()->all()
            : []
    );

    $initialLinks = old(
        'links',
        $editing
            ? collect($idea->links ?? [])->values()->all()
            : []
    );
@endphp

<x-modal :name="$modalName" :title="$modalTitle">
    <form
        method="POST"
        action="{{ $formAction }}"
        enctype="multipart/form-data"
        x-data="{
            status: @js($initialStatus),
            newStep: '',
            steps: @js($initialSteps),
            newLink: '',
            links: @js($initialLinks),
        }"
        data-test="{{ $formTest }}"
        class="space-y-6"
    >
        @csrf

        @if ($editing)
            @method('PATCH')
        @endif

        <div class="space-y-2">
            <label for="{{ $titleId }}" class="label">
                Título
            </label>

            <input
                id="{{ $titleId }}"
                name="title"
                type="text"
                value="{{ old('title', $idea?->title) }}"
                placeholder="Ingresa el título de tu idea"
                class="input w-full"
                required
                autofocus
            >

            <x-forms.error name="title" />
        </div>

        <div class="space-y-2">
            <label for="{{ $descriptionId }}" class="label">
                Descripción
            </label>

            <textarea
                id="{{ $descriptionId }}"
                name="description"
                placeholder="Describe brevemente tu idea"
                class="textarea min-h-32 w-full"
            >{{ old('description', $idea?->description) }}</textarea>

            <x-forms.error name="description" />
        </div>

        <div class="space-y-2">
            <label for="{{ $imageId }}" class="label">
                {{ $editing ? 'Reemplazar imagen destacada' : 'Imagen destacada' }}
            </label>

            @if ($editing && $idea->image_path)
                <div class="overflow-hidden rounded-xl border border-border">
                    <img
                        src="{{ asset('storage/' . $idea->image_path) }}"
                        alt="Imagen destacada actual de {{ $idea->title }}"
                        class="h-40 w-full object-cover"
                    >
                </div>

                <p class="text-xs text-muted">
                    Selecciona otra imagen solamente si deseas reemplazar la actual.
                </p>
            @endif

            <input
                id="{{ $imageId }}"
                name="image"
                type="file"
                accept="image/*"
                data-test="featured-image-input"
                class="block w-full rounded-xl border border-border bg-background px-4 py-3 text-sm text-foreground file:mr-4 file:rounded-full file:border-0 file:bg-primary file:px-4 file:py-2 file:text-sm file:font-semibold file:text-primary-foreground"
            >

            <x-forms.error name="image" />
        </div>

        <fieldset class="space-y-3">
            <legend class="label">
                Pasos accionables
            </legend>

            <div class="space-y-3">
                <template
                    x-for="(step, index) in steps"
                    :key="`step-${index}-${step}`"
                >
                    <div class="flex items-center gap-3">
                        <label
                            class="sr-only"
                            :for="`{{ $modalName }}-step-${index}`"
                        >
                            Paso accionable agregado
                        </label>

                        <input
                            type="text"
                            name="steps[]"
                            x-model="steps[index]"
                            :id="`{{ $modalName }}-step-${index}`"
                            class="input flex-1"
                            readonly
                        >

                        <button
                            type="button"
                            class="button button-outline h-12 w-12 shrink-0 px-0 text-lg"
                            x-on:click="steps.splice(index, 1)"
                            data-test="remove-step-button"
                            aria-label="Eliminar paso"
                        >
                            ×
                        </button>
                    </div>
                </template>
            </div>

            <div class="flex items-center gap-3">
                <label class="sr-only" for="{{ $newStepId }}">
                    Nuevo paso accionable
                </label>

                <input
                    id="{{ $newStepId }}"
                    type="text"
                    x-model.trim="newStep"
                    x-on:keydown.enter.prevent="if (newStep.trim()) { steps.push(newStep.trim()); newStep = '' }"
                    placeholder="¿Qué se debe hacer?"
                    autocomplete="off"
                    spellcheck="false"
                    data-test="new-step-input"
                    class="input flex-1"
                >

                <button
                    type="button"
                    class="button h-12 w-12 shrink-0 px-0 text-lg disabled:cursor-not-allowed disabled:opacity-50"
                    x-bind:disabled="!newStep.trim()"
                    x-on:click="if (newStep.trim()) { steps.push(newStep.trim()); newStep = '' }"
                    data-test="submit-new-step-button"
                    aria-label="Agregar paso"
                >
                    +
                </button>
            </div>

            <x-forms.error name="steps" />

            @error('steps.*')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </fieldset>

        <fieldset class="space-y-3">
            <legend class="label">
                Enlaces
            </legend>

            <div class="space-y-3">
                <template
                    x-for="(link, index) in links"
                    :key="`link-${index}-${link}`"
                >
                    <div class="flex items-center gap-3">
                        <label
                            class="sr-only"
                            :for="`{{ $modalName }}-link-${index}`"
                        >
                            Enlace agregado
                        </label>

                        <input
                            type="url"
                            name="links[]"
                            x-model="links[index]"
                            :id="`{{ $modalName }}-link-${index}`"
                            class="input flex-1"
                            readonly
                        >

                        <button
                            type="button"
                            class="button button-outline h-12 w-12 shrink-0 px-0 text-lg"
                            x-on:click="links.splice(index, 1)"
                            aria-label="Eliminar enlace"
                        >
                            ×
                        </button>
                    </div>
                </template>
            </div>

            <div class="flex items-center gap-3">
                <label class="sr-only" for="{{ $newLinkId }}">
                    Nuevo enlace
                </label>

                <input
                    id="{{ $newLinkId }}"
                    type="url"
                    x-model.trim="newLink"
                    x-on:keydown.enter.prevent="if (newLink.trim()) { links.push(newLink.trim()); newLink = '' }"
                    placeholder="https://ejemplo.com"
                    autocomplete="url"
                    spellcheck="false"
                    data-test="new-link-input"
                    class="input flex-1"
                >

                <button
                    type="button"
                    class="button h-12 w-12 shrink-0 px-0 text-lg disabled:cursor-not-allowed disabled:opacity-50"
                    x-bind:disabled="!newLink.trim()"
                    x-on:click="if (newLink.trim()) { links.push(newLink.trim()); newLink = '' }"
                    data-test="submit-new-link-button"
                    aria-label="Agregar enlace"
                >
                    +
                </button>
            </div>

            <x-forms.error name="links" />

            @error('links.*')
                <p class="mt-2 text-sm text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </fieldset>

        <div class="space-y-2">
            <label for="{{ $statusId }}" class="label">
                Estado
            </label>

            <div class="grid gap-3 sm:grid-cols-3">
                @foreach (\App\Enums\IdeaStatus::cases() as $status)
                    <button
                        type="button"
                        x-on:click="status = @js($status->value)"
                        x-bind:class="{
                            'button-outline': status !== @js($status->value)
                        }"
                        class="button h-12"
                        data-test="status-button-{{ $status->value }}"
                    >
                        {{ $status->label() }}
                    </button>
                @endforeach
            </div>

            <input
                id="{{ $statusId }}"
                name="status"
                type="hidden"
                x-bind:value="status"
            >

            <x-forms.error name="status" />
        </div>

        <footer class="flex items-center justify-end gap-3 pt-4">
            <button
                type="button"
                class="button button-outline"
                x-on:click="$dispatch('close-modal')"
                data-test="{{ $cancelTest }}"
            >
                Cancelar
            </button>

            <button
                type="submit"
                class="button"
                data-test="{{ $submitTest }}"
            >
                {{ $submitLabel }}
            </button>
        </footer>
    </form>
</x-modal>