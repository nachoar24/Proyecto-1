<x-layout title="Mis ideas">
    <div class="space-y-10">
        <header class="mx-auto max-w-2xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-foreground">
                Mis ideas
            </h1>

            <p class="mt-3 text-sm text-muted">
                Organiza, revisa y da seguimiento a tus ideas.
            </p>
        </header>

        <x-card
            as="button"
            data-test="create-idea-button"
            onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-idea' }))"
            class="flex h-28 w-full items-center justify-center text-center"
        >
            <span class="text-lg font-semibold text-foreground">
                ¿Cuál es tu idea?
            </span>
        </x-card>

        <div class="flex flex-wrap items-center justify-center gap-3">
            <a
                href="{{ route('ideas.index') }}"
                class="button {{ $currentStatus ? 'button-outline' : '' }}"
            >
                Todas
                <span class="pl-1 text-xs">
                    {{ $statusCounts->get('all', 0) }}
                </span>
            </a>

            @foreach ($statuses as $status)
                <a
                    href="{{ route('ideas.index', ['status' => $status->value]) }}"
                    class="button {{ $currentStatus === $status->value ? '' : 'button-outline' }}"
                >
                    {{ $status->label() }}

                    <span class="pl-1 text-xs">
                        {{ $statusCounts->get($status->value, 0) }}
                    </span>
                </a>
            @endforeach
        </div>

        @if ($ideas->isEmpty())
            <x-card class="mx-auto max-w-xl text-center">
                <h2 class="text-lg font-semibold text-foreground">
                    @if ($currentStatus)
                        No hay ideas para este filtro
                    @else
                        Aún no tienes ideas
                    @endif
                </h2>

                <p class="mt-2 text-muted">
                    @if ($currentStatus)
                        Prueba seleccionando otro estado o revisa todas tus ideas.
                    @else
                        Cuando registres una idea, aparecerá en esta sección.
                    @endif
                </p>

                @if ($currentStatus)
                    <a href="{{ route('ideas.index') }}" class="button mt-6">
                        Ver todas
                    </a>
                @else
                    <button
                        type="button"
                        class="button mt-6"
                        onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'create-idea' }))"
                    >
                        Crear idea
                    </button>
                @endif
            </x-card>
        @else
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($ideas as $idea)
                    @php
                        $usesLegacyDescriptionAsTitle = $idea->title === 'Untitled idea' && filled($idea->description);

                        $title = $usesLegacyDescriptionAsTitle
                            ? $idea->description
                            : $idea->title;

                        $description = $usesLegacyDescriptionAsTitle
                            ? null
                            : $idea->description;
                    @endphp

                    <x-card href="{{ route('ideas.show', $idea) }}" class="min-h-40 overflow-hidden">
                        <div class="flex h-full flex-col justify-between gap-6">
                            @if ($idea->image_path)
                                <div class="-mx-4 -mt-4 overflow-hidden rounded-t-2xl">
                                    <img
                                        src="{{ asset('storage/' . $idea->image_path) }}"
                                        alt="Imagen destacada de {{ $title }}"
                                        class="h-40 w-full object-cover"
                                    >
                                </div>
                            @endif

                            <div class="space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <h2 class="max-w-[75%] text-lg font-semibold leading-snug text-foreground">
                                        {{ $title }}
                                    </h2>

                                    <x-idea.status-label :status="$idea->status" />
                                </div>

                                @if ($description)
                                    <p class="text-sm leading-6 text-muted">
                                        {{ $description }}
                                    </p>
                                @endif
                            </div>

                            <p class="text-xs text-muted">
                                Creada {{ $idea->created_at->locale('es')->diffForHumans() }}
                            </p>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>

    <x-modal name="create-idea" title="Nueva idea">
        <form
            method="POST"
            action="{{ route('ideas.store', [], false) }}"
            enctype="multipart/form-data"
            x-data="{
                status: @js(old('status', \App\Enums\IdeaStatus::Pending->value)),
                newStep: '',
                steps: @js(old('steps', [])),
                newLink: '',
                links: @js(old('links', [])),
            }"
            data-test="create-idea-form"
            class="space-y-6"
        >
            @csrf

            <x-forms.field
                label="Título"
                name="title"
                placeholder="Ingresa el título de tu idea"
                required
                autofocus
            />

            <x-forms.field
                label="Descripción"
                name="description"
                type="textarea"
                placeholder="Describe brevemente tu idea"
            />

            <div class="space-y-2">
                <label for="image" class="label">
                    Imagen destacada
                </label>

                <input
                    id="image"
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
                    <template x-for="(step, index) in steps" :key="`step-${index}-${step}`">
                        <div class="flex items-center gap-3">
                            <label class="sr-only" :for="`step-${index}`">
                                Paso accionable agregado
                            </label>

                            <input
                                type="text"
                                name="steps[]"
                                x-model="steps[index]"
                                :id="`step-${index}`"
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
                    <label class="sr-only" for="new_step">
                        Nuevo paso accionable
                    </label>

                    <input
                        id="new_step"
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
                    <template x-for="(link, index) in links" :key="link">
                        <div class="flex items-center gap-3">
                            <label class="sr-only" :for="`link-${index}`">
                                Enlace agregado
                            </label>

                            <input
                                type="url"
                                name="links[]"
                                x-model="links[index]"
                                :id="`link-${index}`"
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
                    <label class="sr-only" for="new_link">
                        Nuevo enlace
                    </label>

                    <input
                        id="new_link"
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
                <label for="status" class="label">
                    Estado
                </label>

                <div class="grid gap-3 sm:grid-cols-3">
                    @foreach (\App\Enums\IdeaStatus::cases() as $status)
                        <button
                            type="button"
                            x-on:click="status = @js($status->value)"
                            x-bind:class="{ 'button-outline': status !== @js($status->value) }"
                            class="button h-12"
                            data-test="status-button-{{ $status->value }}"
                        >
                            {{ $status->label() }}
                        </button>
                    @endforeach
                </div>

                <input
                    id="status"
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
                    data-test="cancel-create-idea-button"
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="button"
                    data-test="submit-create-idea-button"
                >
                    Crear idea
                </button>
            </footer>
        </form>
    </x-modal>
</x-layout>