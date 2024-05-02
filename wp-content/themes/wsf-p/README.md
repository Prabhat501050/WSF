# Wayne-Sanderson Farms Website

Wordpress template for the corporate website.

## Table of Contents

- [Installation](#installation)
- [Asset Compiling](#asset-compiling)
- [Component Generation](#component-generation)
- [Tailwind](#tailwind)
- [Template Parts](#template-parts)

## Installation

1. Navigate to the theme directory `wsf`.
2. Run npm or yarn install.
3. Configure your local environment.
4. Run `npx mix watch` to start the development build.

## Asset Compiling

-   Run `yarn install` or `npm install` to install the dependencies
-   Create a .env file at the root of the theme (cf. `.env-example` file) and set the `MIX_PROXY` variable to your local site address
-   Run `npx mix watch` to start the asset building process
-   Run `npx mix --production` to minify the css and js for production

## Component Generation

-   Generate a new block with `yarn generate block BlockName`, this will:
    -   Create a new block folder
    -   Automatically register the new block with ACF (in the `CustomBlocks.php` file)
    -   Make the block available for import from the `blocks/index.js` file (99% of the time it won't be necessary, but it's available)
-   Generate a new module with `yarn generate global ModuleName`:
    -   This will create a new file under the `src/global` folder
    -   The newly created module will automatically be called (i.e. its `init` method will be called) on document load (cf. `app.js`)
    -   This is intended for site-wide functionality such as modals etc.
    -   Feel free to import when needed; for example: you have a one-off modal you need to show programatically. You can call `Modals.show()` to show it wherever you need to (in a block's js for instance)

## Tailwind

-   TailwindCSS is included by default, documentation is (here)[https://tailwindcss.com/docs/editor-setup]. If you're using VSCode you should install the recommended extension.

## Template Parts

-   Modal: include a single modal with `get_template_part('template-parts/modal', null, ['id' => 'your-modal-id', 'content' => 'your modal content'])
