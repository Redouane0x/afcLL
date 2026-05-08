<x-app-layout>

    <div class="py-12 max-w-7xl mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-12">

            {{-- 🔥 PREVIEW --}}
            <div class="bg-white p-6 rounded-3xl shadow-md flex flex-col items-center gap-4">

                {{-- SWITCH --}}
                <div class="flex gap-4">
                    <button onclick="switchSide('back')" class="switch-btn">Dos</button>
                    <button onclick="switchSide('front')" class="switch-btn">Avant</button>
                </div>

                <div class="relative w-[320px]" id="jersey">

                    {{-- IMAGE --}}
                    <img id="jerseyImage"
                         src="{{ $product->image_url ? asset('storage/'.$product->image_url) : 'https://via.placeholder.com/400x500' }}"
                         class="w-full rounded-2xl">

                    {{-- TEXT --}}
                    <div id="draggableText"
                         class="absolute top-[40%] left-1/2 -translate-x-1/2 text-center text-white font-bold cursor-move select-none">

                        <div id="previewName" class="text-lg"></div>
                        <div id="previewNumber" class="text-4xl"></div>

                    </div>

                </div>

            </div>

            {{-- CONFIG --}}
            <div class="space-y-6">

                <h1 class="text-3xl font-bold">{{ $product->name }}</h1>

                <p class="text-green-600 text-3xl font-bold">{{ $product->price }} €</p>

                <form method="POST" action="{{ route('cart.add') }}" class="space-y-6">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="size" id="selectedSize">

                    {{-- NOM --}}
                    <input name="custom_name"
                           placeholder="Nom"
                           class="input"
                           oninput="updatePreview()">

                    {{-- NUMERO --}}
                    <input name="custom_number"
                           placeholder="Numéro"
                           class="input"
                           oninput="updatePreview()">

                    {{-- 🎨 COULEUR --}}
                    <div>
                        <p class="font-semibold">Couleur</p>
                        <div class="flex gap-2 mt-2">
                            <div class="color" style="background:white" onclick="setColor('white')"></div>
                            <div class="color" style="background:black" onclick="setColor('black')"></div>
                            <div class="color" style="background:red" onclick="setColor('red')"></div>
                            <div class="color" style="background:yellow" onclick="setColor('yellow')"></div>
                        </div>
                    </div>

                    {{-- 🔤 POLICE --}}
                    <div>
                        <p class="font-semibold">Police</p>

                        <select onchange="setFont(this.value)" class="input">
                            <option value="sans-serif">Standard</option>
                            <option value="monospace">Sport</option>
                            <option value="cursive">Stylé</option>
                        </select>
                    </div>

                    {{-- TAILLES --}}
                    @if($product->sizes_array)
                        <div class="flex gap-2 flex-wrap">
                            @foreach($product->sizes_array as $size)
                                <button type="button"
                                        onclick="selectSize('{{ $size }}', this)"
                                        class="size-btn">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    @endif

                    <button class="btn-add">Ajouter au panier</button>

                </form>

            </div>

        </div>

    </div>

    <style>

        /* INPUT */
        .input {
            width: 100%;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
        }

        /* BTN */
        .btn-add {
            width: 100%;
            background: #16a34a;
            color: white;
            padding: 14px;
            border-radius: 12px;
        }

        /* SIZE */
        .size-btn {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 10px;
        }
        .size-btn.active {
            background: #16a34a;
            color: white;
        }

        /* COLOR */
        .color {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid #ddd;
        }

        /* SWITCH */
        .switch-btn {
            background: #eee;
            padding: 6px 12px;
            border-radius: 6px;
        }

    </style>

    <script>

        // PREVIEW
        function updatePreview() {
            let name = document.querySelector('[name="custom_name"]').value;
            let number = document.querySelector('[name="custom_number"]').value;

            document.getElementById('previewName').innerText = name.toUpperCase();
            document.getElementById('previewNumber').innerText = number;
        }

        // COLOR
        function setColor(color) {
            document.getElementById('draggableText').style.color = color;
        }

        // FONT
        function setFont(font) {
            document.getElementById('draggableText').style.fontFamily = font;
        }

        // SIZE
        function selectSize(size, el) {
            document.getElementById('selectedSize').value = size;

            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('active');
            });

            el.classList.add('active');
        }

        // SWITCH MAILLOT
        function switchSide(side) {
            let img = document.getElementById('jerseyImage');

            if (side === 'front') {
                img.style.filter = "brightness(0.9)";
            } else {
                img.style.filter = "brightness(1)";
            }
        }

        // DRAG
        let el = document.getElementById("draggableText");

        el.onmousedown = function(e) {
            e.preventDefault();

            document.onmousemove = function(e) {
                el.style.left = e.pageX - el.parentElement.offsetLeft + "px";
                el.style.top = e.pageY - el.parentElement.offsetTop + "px";
            };

            document.onmouseup = function() {
                document.onmousemove = null;
            };
        };

    </script>

</x-app-layout>
