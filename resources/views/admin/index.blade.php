<x-layout title="Administración">
    <section class="card bg-base-200 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl">Área de administración</h1>

            <p>
                Esta es una sección privada del sitio. Solamente los usuarios autorizados
                pueden acceder a esta página.
            </p>

            <div class="alert alert-info mt-4">
                <span>
                    Acceso permitido mediante el Gate <strong>view-admin</strong>.
                </span>
            </div>

            <div class="card-actions mt-6">
                <a href="/ideas" class="btn btn-primary">
                    Volver a ideas
                </a>
            </div>
        </div>
    </section>
</x-layout>