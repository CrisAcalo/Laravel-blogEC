<div class="text-center mx-auto mb-3">
    <h1 class="text-start text-2xl font-semibold mb-4">Actualizar Imagen</h1>

    <form id="imageForm" action="{{ route('admin.categories.updateImage', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Contenedor de imagen con efecto -->
        <div id="imageContainer"
            class="w-3/4 rounded-md mx-auto border border-gray-300 shadow-md min-h-28 cursor-pointer relative group overflow-hidden">

            <!-- Imagen con desenfoque y oscurecimiento al hacer hover -->
            <img id="previewImage" src="{{ Storage::url($category->image) }}"
                alt="Imagen de {{ $category->name }}"
                class="object-cover rounded-md w-full transition duration-150 group-hover:blur-sm group-hover:brightness-75" style="height:600px">

            <!-- Texto que aparece al hacer hover -->
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-150">
                <span class="text-white text-2xl font-semibold">Actualizar imagen</span>
            </div>

            <!-- Input oculto -->
            <input type="file" id="fileInput" name="image" class="hidden" accept="image/*" onchange="document.getElementById('imageForm').submit();">
        </div>
    </form>
</div>

<script>
    document.getElementById('imageContainer').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });
</script>
