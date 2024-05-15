# Headache

> An easy-to-swallow painkiller plugin for WordPress.

The plugin removes a lot of default WordPress stuff you just can't wait to get rid of. It removes meta tags such as feeds, version numbers and emojis.

[![Build Status](https://badgen.net/github/checks/vinkla/headache?label=build&icon=github)](https://github.com/vinkla/headache/actions)
[![Monthly Downloads](https://badgen.net/packagist/dm/vinkla/headache)](https://packagist.org/packages/vinkla/headache/stats)
[![Latest Version](https://badgen.net/packagist/v/vinkla/headache)](https://packagist.org/packages/vinkla/headache)

## Installation

Require the package, with Composer, in the root directory of your project.

```sh
composer require vinkla/headache
```

The plugin will be installed as a [must-use plugin](https://github.com/vinkla/wordplate#must-use-plugins).

## Features

All features are activated by default when the plugin is activated.

- Disable default users API endpoints for security
- Disable XML RPC for security
- Disable comments
- Disable comments feeds
- Disable feeds
- Disable attachment pages
- Discourage search engines from indexing in non-production environments
- Remove contributor, subscriber and author roles
- Remove Gutenberg's front-end block styles
- Remove Gutenberg's core block styles
- Remove Gutenberg's global styles
- Remove Gutenberg's SVG filters
- Remove classic theme styles
- Remove ?ver= query from styles and scripts
- Remove all extra RSS feed links
- Remove emojis
- Remove generated icons
- Remove JPEG compression
- Remove language dropdown on login screen
- Remove meta rel=dns-prefetch href=//s.w.org
- Remove oEmbeds
- Remove Really Simple Discovery link
- Remove relational links for the posts
- Remove reserved attachment slugs
- Remove REST API link tag from `<head>` and HTML headers
- Remove RSS feed links
- Remove shortlink tag from `<head>` and HTML headers
- Remove wlwmanifest.xml
- Remove WordPress version
- Update login page image link URL
- Update login page link title
- Update the permalink structure to `/%postname%/`
