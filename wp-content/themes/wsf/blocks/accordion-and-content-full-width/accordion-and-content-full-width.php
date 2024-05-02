<?php

$blockFields = get_fields();
$customBlock = PXUtils::parse_custom_block($block, $blockFields);

if (is_array($blockFields)) {
    extract($blockFields);
} else {
    extract($block['data']);
}
?>

<div id="<?= $customBlock->id ?>" data-anchor="<?= $customBlock->id ?>"
    data-anchor-label="<?= $customBlock->anchorLabel ?>" class=" <?= $customBlock->classesString ?>">
    <?= $is_preview ? '<span class="block-preview-label">' . $customBlock->title . '</span>' : '' ?>

    <section id="accordion" class="pb-[124px]">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion accordion-flush pb-5">
                        <div class="accordion-item" id="Alabamacontent">

                            <h2 class="accordion-header">
                                <span class="flex">
                                    <img class="h-24 w-auto border"
                                        src="<?= get_template_directory_uri() ?>/assets/images/svg-map-images/Alabama_1.png"
                                        alt="">

                                    <button class="accordion-button collapsed" type="button"> Alabama </button>
                                </span>
                            </h2>

                            <div class="accordion-collapse collapsed hidden">
                                <div class="accordion-body">
                                    <div class="d-flex align-content-start flex-wrap">
                                        <a class="btn btn-primary btn-finger-white btn-inline-block"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms?locations=71c71a8a2d2510fc09373d5b8b324352&amp;locations=71c71a8a2d2510fc0937430091cc4357&amp;locations=71c71a8a2d2510fc093737cad884434b"
                                            target="_blank" rel="noopener">Albertville, AL</a> <a
                                            class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms?locations=71c71a8a2d2510fc09367ee04db94299&amp;locations=71c71a8a2d2510fc093709a70bf7431f&amp;locations=71c71a8a2d2510fc09370f2a0a7e4326"
                                            target="_blank" rel="noopener">Decatur, AL</a> <a
                                            class="btn btn-primary btn-finger-white mt-0"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms?locations=71c71a8a2d2510fc0936a2623f4e42bd&amp;locations=71c71a8a2d2510fc093676feb2124294&amp;locations=71c71a8a2d2510fc09369ce1902e42b8&amp;locations=71c71a8a2d2510fc0936a830e37042c2"
                                            target="_blank" rel="noopener">Dothan, AL</a> <a
                                            class="btn btn-primary btn-finger-white mt-0"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms?locations=71c71a8a2d2510fc0936beaf2d7042d7&amp;locations=71c71a8a2d2510fc0936b63ee5bf42d0"
                                            target="_blank" rel="noopener">Enterprise, AL</a> <a
                                            class="btn btn-primary btn-finger-white mt-0"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms?locations=71c71a8a2d2510fc0936870b528242a0"
                                            target="_blank" rel="noopener">Union Springs, AL</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" id="ARKANSAScontent">
                            <h2 class="accordion-header">
                                <span class="flex">
                                    <img class="h-24 w-auto"
                                        src="<?= get_template_directory_uri() ?>/assets/images/svg-map-images/Ark.png"
                                        alt="">
                                    <button class="accordion-button collapsed" type="button"> ARKANSAS </button>
                                </span>
                            </h2>
                            <!-- <div class="accordion-collapse collapsed hidden" aria-labelledby="flush-headingTwo"> -->
                            <div class="accordion-collapse collapsed hidden">
                                <div class="accordion-body">
                                    <div class="d-flex align-content-start flex-wrap">
                                        <a class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms?locations=71c71a8a2d2510fc09371b4b34e24332&amp;locations=71c71a8a2d2510fc093714c970a2432b"
                                            target="_blank" rel="noopener">Danville, AR</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" id="GEORGIAcontent">
                            <h2 class="accordion-header">
                                <span class="flex">
                                    <img class="h-24 w-auto"
                                        src="<?= get_template_directory_uri() ?>/assets/images/svg-map-images/Georgia.png"
                                        alt="">
                                    <button class="accordion-button collapsed" type="button"> GEORGIA </button>
                                </span>
                            </h2>
                            <div class="accordion-collapse collapsed hidden">
                                <div class="accordion-body">
                                    <div class="d-flex align-content-start flex-wrap">
                                        <a class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9a310dad1b0000&amp;locations=abe2fffc98a51001bd9a27fa8ad40000&amp;locations=abe2fffc98a51001bd9a398360f30000"
                                            target="_blank" rel="noopener">Moultrie, GA</a> <a
                                            class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/WayneFarms?locations=71c71a8a2d2510fc0936d1404c3042e8&amp;locations=71c71a8a2d2510fc0936d8abfb5242ef&amp;locations=71c71a8a2d2510fc0936c9cf207e42e1"
                                            target="_blank" rel="noopener">Pendergrass, GA</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" id="LOUISIANAcontent">
                            <h2 class="accordion-header">
                                <span class="flex">
                                    <img class="h-24 w-auto"
                                        src="<?= get_template_directory_uri() ?>/assets/images/svg-map-images/Louisiana.png"
                                        alt="">
                                    <button class="accordion-button collapsed" type="button"> LOUISIANA </button>
                                </span>
                            </h2>
                            <div class="accordion-collapse collapsed  hidden">
                                <div class="accordion-body">
                                    <div class="d-flex align-content-start flex-wrap">
                                        <a class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd999190970f0000"
                                            target="_blank" rel="noopener">Hammond, LA</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" id="MISSISSIPPIcontent">
                            <h2 class="accordion-header">
                                <span class="flex">
                                    <img class="h-24 w-auto"
                                        src="<?= get_template_directory_uri() ?>/assets/images/svg-map-images/Mississippi.png"
                                        alt="">
                                    <button class="accordion-button collapsed" type="button"> MISSISSIPPI </button>
                                </span>
                            </h2>
                            <div class="accordion-collapse collapsed hidden">
                                <div class="accordion-body">
                                    <div class="d-flex align-content-start flex-wrap">
                                        <a class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd99b846640a0000&amp;locations=abe2fffc98a51001bd99c0b9a9ae0000&amp;locations=abe2fffc98a51001bd99cb0196e00000"
                                            target="_blank" rel="noopener">Collins, MS</a> <a
                                            class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9a89b6f14e0000&amp;locations=401b5678702c100166a7b7bb425b0000"
                                            target="_blank" rel="noopener">Flowood, MS</a> <a
                                            class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd999bda09210000&amp;locations=abe2fffc98a51001bd99adff41170000&amp;locations=abe2fffc98a51001bd99a4eac1f30000"
                                            target="_blank" rel="noopener">Hazlehurst, MS</a> <a
                                            class="btn btn-primary btn-finger-white mt-0"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9aacadbe550000&amp;locations=abe2fffc98a51001bd9967eeb42a0000&amp;locations=abe2fffc98a51001bd998619102c0000"
                                            target="_blank" rel="noopener">Laurel, MS</a> <a
                                            class="btn btn-primary btn-finger-white mt-0"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd99efd199b50000"
                                            target="_blank" rel="noopener">McComb, MS</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" id="NORTHCAROLINAcontent">
                            <h2 class="accordion-header">
                                <span class="flex">
                                    <img class="h-24 w-auto border"
                                        src="<?= get_template_directory_uri() ?>/assets/images/svg-map-images/North_Carolin.png"
                                        alt="">
                                    <button class="accordion-button collapsed" type="button"> NORTH CAROLINA</button>
                                </span>
                            </h2>
                            <div class="accordion-collapse collapsed hidden">
                                <div class="accordion-body">
                                    <div class="d-flex align-content-start flex-wrap">
                                        <a class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=71c71a8a2d2510fc0936f20acd9e4307&amp;locations=71c71a8a2d2510fc0936f876b0f4430e&amp;locations=71c71a8a2d2510fc0937041c0c98431a"
                                            target="_blank" rel="noopener">Dobson, NC</a> <a
                                            class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9a92286fa80000&amp;locations=abe2fffc98a51001bd9a9a94be770000&amp;locations=abe2fffc98a51001bd9aa3a4255c0000"
                                            target="_blank" rel="noopener">Kinston, NC</a> <a
                                            class="btn btn-primary btn-finger-white mt-0"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9a5d14608f0000&amp;locations=abe2fffc98a51001bd9a658f78560000"
                                            target="_blank" rel="noopener">St. Pauls, NC</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" id="TEXAScontent">
                            <h2 class="accordion-header">
                                <span class="flex">
                                    <img class="h-24 w-auto border"
                                        src="<?= get_template_directory_uri() ?>/assets/images/svg-map-images/Texas.png"
                                        alt="">
                                    <button class="accordion-button collapsed" type="button"> TEXAS</button>
                                </span>
                            </h2>
                            <div class="accordion-collapse collapsed hidden">
                                <div class="accordion-body">
                                    <div class="d-flex align-content-start flex-wrap">
                                        <a class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9a5406a7310000&amp;locations=abe2fffc98a51001bd9a4afb234a0000&amp;locations=abe2fffc98a51001bd9a41f2b8a30000"
                                            target="_blank" rel="noopener">Palestine, TX</a> <a
                                            class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9a1ee808b60000&amp;locations=abe2fffc98a51001bd9a0b98e5680000"
                                            target="_blank" rel="noopener">Bryan, TX</a> <a
                                            class="btn btn-primary btn-finger-white"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd9a6fd309050000&amp;locations=abe2fffc98a51001bd9a81475faa0000"
                                            target="_blank" rel="noopener">Tyler, TX</a> <a
                                            class="btn btn-primary btn-finger-white mt-0"
                                            href="https://waynefarms.wd1.myworkdayjobs.com/en-US/WayneFarms?locations=abe2fffc98a51001bd99d4a411730000&amp;locations=abe2fffc98a51001bd99de5359320000"
                                            target="_blank" rel="noopener">Waco, TX</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<style>
.careermap-area>.search-form {
    height: 60px;
    border: 1px solid #282828;
    width: 80%;
    display: flex;
    align-items: center;

}

.careermap-area>.search-form label[for=search] input {
    width: 100%;
    border: 0;
}

.careermap-area [type='search'] {
    background: transparent;
    width: 100%;
}

.careermap-area label.search-label {
    width: 100%;
}

.careermap-area .search-form label[for=search] input:focus-visible {
    outline: none;
}

.careermap-area input[type=submit] {
    flex: 0 0 auto;
    border-radius: 50%;
    padding: 0;
    background-image: url(/wp-content/themes/wsf/assets/icons/search-white.svg);
    background-color: #b11f28;
    background-size: 20px;
    background-repeat: no-repeat;
    background-position: center;
    text-indent: -209px;
    margin-left: 5px;
    margin-right: -30px;
}


.careermap-area .search-form input,
select,
textarea {
    border: 0;
    outline: none;
}

.accordion-button {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    padding: var(--map-accordion-btn-padding-y) var(--map-accordion-btn-padding-x);
    font-size: 3rem;
    color: #98252c;
    text-transform: uppercase;
    text-align: left;
    background-color: var(--map-accordion-btn-bg);
    border: 0;
    border-radius: 0;
    overflow-anchor: none;
    transition: all ease 0.5s;
}

.accordion-button:not(.collapsed) {
    color: #ffffff;
    background-color: #69101d;
    outline: none;
    transition: all ease 1s;
}

.accordion-button:not(.collapsed):focus {
    border-color: none;
    outline: 0;
    box-shadow: none;

}

.accordion-button:focus {
    z-index: 3;
    border-color: none;
    outline: 0;
    box-shadow: none;
}


.accordion-item {
    transition: all ease 0.6s;
    margin-bottom: 10px;
    box-shadow: 0px 8px 11px 0px #5a57572e;
}

.accordion-item:hover {
    transform: translate(0px, 0px) scale(0.97);
    transition: all ease 0.5s;
    box-shadow: 0px 0px 0px 0px #5a57572e;
}

.accordion-collapse {
    transition: .5s ease-out;
}

.accordion {
    --map-accordion-color: #212529;
    --map-accordion-bg: #fff;
    --map-accordion-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, border-radius 0.15s ease;
    --map-accordion-border-color: var(--map-border-color);
    --map-accordion-border-width: 1px;
    --map-accordion-border-radius: 0.375rem;
    --map-accordion-inner-border-radius: calc(0.375rem - 1px);
    --map-accordion-btn-padding-x: 1.25rem;
    --map-accordion-btn-padding-y: 1rem;
    --map-accordion-btn-color: #212529;
    --map-accordion-btn-bg: var(--map-accordion-bg);
    --map-accordion-btn-icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="41" height="41" fill="none" viewBox="0 0 41 41"><path fill="%2369101D" d="M35.969 14.455h-30c-1.326 0-2.598.65-3.536 1.809C1.496 17.42.97 18.992.97 20.629c0 1.638.527 3.208 1.464 4.366.938 1.158 2.21 1.809 3.536 1.809h30c1.326 0 2.598-.65 3.535-1.809.938-1.158 1.465-2.728 1.465-4.366 0-1.637-.527-3.208-1.465-4.366-.937-1.157-2.21-1.808-3.535-1.808Z"/><path fill="%2369101D" d="M27.143 35.63v-30c0-1.326-.65-2.598-1.809-3.536C24.176 1.157 22.606.63 20.968.63c-1.637 0-3.208.527-4.366 1.464-1.157.938-1.808 2.21-1.808 3.536v30c0 1.326.65 2.598 1.808 3.535 1.158.938 2.729 1.465 4.366 1.465 1.638 0 3.208-.527 4.366-1.465 1.158-.937 1.809-2.209 1.809-3.535Z"/></svg>');
    --map-accordion-btn-icon-width: 1.25rem;
    --map-accordion-btn-icon-transform: rotate(-180deg);
    --map-accordion-btn-icon-transition: transform 0.2s ease-in-out;
    --map-accordion-btn-active-icon: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="41" height="13" fill="none" viewBox="0 0 41 13"><path fill="%2369101D" d="M35.969.455h-30c-1.326 0-2.598.65-3.536 1.808C1.496 3.421.97 4.992.97 6.63s.527 3.208 1.464 4.366c.938 1.158 2.21 1.809 3.536 1.809h30c1.326 0 2.598-.65 3.535-1.809.938-1.158 1.465-2.728 1.465-4.366 0-1.637-.527-3.208-1.465-4.366-.937-1.157-2.21-1.808-3.535-1.808Z"/></svg>');
    --map-accordion-btn-focus-border-color: #86b7fe;
    --map-accordion-btn-focus-box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    --map-accordion-body-padding-x: 1.25rem;
    --map-accordion-body-padding-y: 1rem;
    --map-accordion-active-color: #0c63e4;
    --map-accordion-active-bg: #e7f1ff
}

.accordion-header img {
    aspect-ratio: 16 / 9;
    max-width: 4.3em;
}


.accordion-button:not(.collapsed)::after {
    background-image: var(--map-accordion-btn-active-icon);
    transform: var(--map-accordion-btn-icon-transform);
    filter: invert(1) brightness(7.5);
}

.accordion-button::after {
    flex-shrink: 0;
    width: var(--map-accordion-btn-icon-width);
    height: var(--map-accordion-btn-icon-width);
    margin-left: auto;
    content: "";
    background-image: var(--map-accordion-btn-icon);
    background-repeat: no-repeat;
    background-size: var(--map-accordion-btn-icon-width);
    transition: var(--map-accordion-btn-icon-transition)
}

@media (prefers-reduced-motion:reduce) {
    .accordion-button::after {
        transition: none
    }
}

.accordion-button:hover {
    z-index: 2
}

.accordion-header {
    margin-bottom: 0
}

.accordion-item {
    color: var(--map-accordion-color);
    background-color: var(--map-accordion-bg);
    border: var(--map-accordion-border-width) solid var(--map-accordion-border-color)
}

.accordion-item:first-of-type {
    border-top-left-radius: var(--map-accordion-border-radius);
    border-top-right-radius: var(--map-accordion-border-radius)
}

.accordion-item:first-of-type .accordion-button {
    border-top-left-radius: var(--map-accordion-inner-border-radius);
    border-top-right-radius: var(--map-accordion-inner-border-radius)
}

.accordion-item:not(:first-of-type) {
    border-top: 0
}

.accordion-item:last-of-type {
    border-bottom-right-radius: var(--map-accordion-border-radius);
    border-bottom-left-radius: var(--map-accordion-border-radius)
}

.accordion-item:last-of-type .accordion-button.collapsed {
    border-bottom-right-radius: var(--map-accordion-inner-border-radius);
    border-bottom-left-radius: var(--map-accordion-inner-border-radius)
}

.accordion-item:last-of-type .accordion-collapse {
    border-bottom-right-radius: var(--map-accordion-border-radius);
    border-bottom-left-radius: var(--map-accordion-border-radius)
}

.accordion-body {
    padding: var(--map-accordion-body-padding-y) var(--map-accordion-body-padding-x)
}

.accordion-flush .accordion-collapse {
    border-width: 0;
    transition: .5s ease-out;
}

.accordion-flush .accordion-item {
    border-right: 0;
    border-left: 0;
    border-radius: 0;
    /* border-bottom: 1px solid #69101D; */
    border-bottom: 1px solid #69101d38;
}

.accordion-flush .accordion-item:first-child {
    border-top: 0;
}

.accordion-flush .accordion-item:nth-child() {
    border-top: 0;
    border-bottom: 1px solid #69101D;
}

.accordion-flush .accordion-item:last-child {
    border-bottom: 0;
    /* border-bottom: 1px solid #69101D; */
    border-bottom: 1px solid #69101d38;

}

.accordion-flush .accordion-item .accordion-button,
.accordion-flush .accordion-item .accordion-button.collapsed {
    border-radius: 0
}

@media only screen and (max-width:576px) {

    .accordion-header img {
        aspect-ratio: 11 / 7 !important;
    }

    .accordion-button {

        font-size: 2rem !important;
    }
}
</style>