<x-app-layout>

    {{-- HERO SLIDER --}}
    <section class="hero">

        <div class="hero-slider">

            <div class="hero-slide active"
                 style="background-image: url('/images/fond1.JPG')"></div>

            <div class="hero-slide"
                 style="background-image: url('/images/fond2.JPG')"></div>

            <div class="hero-slide"
                 style="background-image: url('/images/fond3.JPG')"></div>

            <div class="hero-slide"
                 style="background-image: url('/images/fond4.JPG')"></div>

        </div>

        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1 class="hero-title">AFC Liébaüt</h1>

            <p class="hero-subtitle">
                Passion • Respect • Discipline
            </p>

            <div class="hero-buttons">
                <a href="/boutique" class="btn-primary">Boutique</a>
                <a href="/actualites" class="btn-secondary">Actualités</a>
            </div>
        </div>

    </section>

    {{-- ACTUALITÉS --}}
    <section class="section">
        <div class="container">

            <h2 class="section-title reveal">Actualités</h2>

            <div class="grid-cards">
                @forelse($news as $index => $item)
                    <div class="card reveal delay-{{ $index + 1 }}">
                        <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/400x200' }}">
                        <div class="card-body">
                            <h3>{{ $item->title }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($item->content, 100) }}</p>
                        </div>
                    </div>
                @empty
                    <p>Aucune actualité</p>
                @endforelse
            </div>

        </div>
    </section>

    {{-- BOUTIQUE --}}
    <section class="section bg-light">
        <div class="container">

            <h2 class="section-title reveal">Boutique officielle</h2>

            <div class="grid-cards">
                @forelse($products as $index => $product)
                    <div class="card reveal delay-{{ $index + 1 }}">
                        <img src="{{ $product->image_url ? asset('storage/'.$product->image_url) : 'https://via.placeholder.com/300' }}">
                        <div class="card-body">
                            <h3>{{ $product->name }}</h3>
                            <p class="price">{{ $product->price }} €</p>
                        </div>
                    </div>
                @empty
                    <p>Aucun produit</p>
                @endforelse
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="cta reveal">
        <h2>Rejoins le club</h2>
        <p>Inscris-toi et fais partie de l’aventure AFCLL</p>
        <a href="/contact" class="btn-primary">Nous contacter</a>
    </section>

</x-app-layout>

{{-- JS SLIDER --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {

        const slides = document.querySelectorAll(".hero-slide");
        let index = 0;

        setInterval(() => {

            slides[index].classList.remove("active");

            index = (index + 1) % slides.length;

            slides[index].classList.add("active");

        }, 5000);

    });
</script>
