# React Components
This module serves as boilerplate / example integration of React with Drupal components.

# Setup for evaluation
* Enable the `react_components module`. This will enable the `react_components_example_content`,
which is a module included that has configuration for a sample content type & View, which
are used in the React components. Enabling this module will also create an instance of this sample
content type.
* You'll have 2 blocks under the `react_components` category that can be placed for
demonstration purposes. The `hello world` block takes a single configuration textfield
and will display it in the React component. The `Example REST React Block` will use the
`axios` library inside a React component to make a REST call to the site to retrieve
a View that is setup to export JSON data of a content type that is all included with
the module.

# Structure / workflow
This example includes a plugin block serves as an example of how any entity
can incorporate a React component scaffolded via Facebook's `create-react-app` tool.

### `src/Plugin/Block/HelloWorldReactBlock`
This is a standard plugin block generated via Drupal console (`drupal generate:plugin:block`),
and simply has a textfield as a configuration option. The value of this field is passed
via drupalSettings to the Javascript layer so that the React component can access it.

### How to develop the JS
Let's take for example the `HelloWorldReactBlock`. You'll see that inside the `js` folder,
we have `js/HelloWorldReactBlock`. This folder is scaffolded from `create-react-app`. This gives all the benefits of the
build process, linting, etc. that come with the official `create-react-app` that Facebook
has created (https://github.com/facebook/create-react-app). In this sense, we are treating
each implementation as an "app". However, it's clear that there is a lot of extra cruft 
that comes with this approach. Currently, the workflow is:
* Create whatever JS is desired, can test it in isolated context with `npm run start`.
This of course limits the ability to actually see, for example, a real context coming
from drupalSettings. However, steps could be taken to provide mock data. Ideally,
React components are written in such a way that not always having the "real" data
shouldn't break anything.
* You'll need to provide the `ReactDOM.render` call which defaults to the div with ID "root"
a unique name, assuming you'll be having more than 1 of these components in use. This is found in
the `index.js`, and also `public/index.html` which creates this div. Technically, we won't even
be using the `public/index.html`, so it only matters if you're testing via `npm run start` pre-Drupal
integration.
* Once the JS is ready, `npm run build` will create an "optimized build" in the `build`
folder. Note that each time the build runs, the hash changes on the JS filename, so
your library will have to update it's reference.
* As alluded to, you'll need to make sure you have a libraries.yml file with a reference
to the build JS. In the markup of whatever thing it is you're using to render, you'll want
to make sure you include the div with the ID you set earlier for the "app root" render call.
* The block (or whatever it is) should now be rendering with the production built JS being
attached. Assuming it can find the div with the proper ID to render, everything should be
off and running, and you can be confident the JS is written in a modern framework (which will
hopefully be relevant for at least a couple months :) )

So as mentioned before, there are definitely extra files that will never be used. Likely,
the best solution would be to create a build script that is configured for this Drupal
based workflow. For now though, these files can simply be `.gitignore`'d, and shouldn't
be taking up hardly any disk space.

## Dynamic library using hook_library_info_alter().
You'll notice that although the example contains 2 blocks, only the `hello-world` one seems
to have a library registered in the `libraries.yml`. That is because our `example-rest-config`
block uses a dynamically registered library. This seems like a better option for the current
workflow, being that the hash on the file changes every time a new `npm run build` is executed.
This hook finds the file inside the build folder and dynamically adds it.

# Known limitations / TODOs
* These example blocks fail if you place more than 1 of them. It is due to the ID of the div
being the "base" of the React rendering process. There should be a way of better handling this,
likely it would be part of moving into a custom scaffolding process instead of `create-react-app`.