@extends('components.layouts.master')
@push('styles')
    <style>
        .scroller {
            max-width: 600px;
            margin: 20px auto
        }

        .scroller__inner {
            padding-block: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .scroller[data-animated="true"] {
            overflow: hidden;
            -webkit-mask: linear-gradient(90deg,
                    transparent,
                    white 20%,
                    white 80%,
                    transparent);
            mask: linear-gradient(90deg, transparent, white 20%, white 80%, transparent);
        }

        .scroller[data-animated="true"] .scroller__inner {
            width: -webkit-max-content;
            width: -moz-max-content;
            width: max-content;
            flex-wrap: nowrap;
            -webkit-animation: scroll var(--_animation-duration, 40s) var(--_animation-direction, forwards) linear infinite;
            animation: scroll var(--_animation-duration, 40s) var(--_animation-direction, forwards) linear infinite;
        }

        .scroller[data-direction="right"] {
            --_animation-direction: reverse;
        }

        .scroller[data-direction="left"] {
            --_animation-direction: forwards;
        }

        .scroller[data-speed="fast"] {
            --_animation-duration: 20s;
        }

        .scroller[data-speed="slow"] {
            --_animation-duration: 60s;
        }

        @-webkit-keyframes scroll {
            to {
                transform: translate(calc(-50% - 0.5rem));
            }
        }

        @keyframes scroll {
            to {
                transform: translate(calc(-50% - 0.5rem));
            }
        }

        .tag-list {
            margin: 0 auto;
            padding-inline: 0;
            list-style: none;
        }

        .tag-list li {
            padding: 1rem;
            background: var(--clr-primary-400);
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem -0.25rem var(--clr-primary-900);
        }
    </style>
@endpush
@section('contents')
    <div>
        @livewire('about')
    </div>
@endsection
@push('scripts')
    <script>
        const scrollers = document.querySelectorAll(".scroller");

        addAnimation();

        function addAnimation() {
            scrollers.forEach((scroller) => {
                // add data-animated="true" to every `.scroller` on the page
                scroller.setAttribute("data-animated", true);

                // Make an array from the elements within `.scroller-inner`
                const scrollerInner = scroller.querySelector(".scroller__inner");
                const scrollerContent = Array.from(scrollerInner.children);

                // For each item in the array, clone it
                // add aria-hidden to it
                // add it into the `.scroller-inner`
                scrollerContent.forEach((item) => {
                    const duplicatedItem = item.cloneNode(true);
                    duplicatedItem.setAttribute("aria-hidden", true);
                    scrollerInner.appendChild(duplicatedItem);
                });
            });
        }
    </script>
@endpush
