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

### Security Features

- **[Disable default users API endpoints for security](https://github.com/vinkla/headache/blob/main/headache.php#L105-L119)**  
  Prevents unauthorized enumeration of usernames through REST API endpoints, enhancing site security against username discovery attacks.

- **[Disable XML RPC for security](https://github.com/vinkla/headache/blob/main/headache.php#L48-L49)**  
  Disables XML-RPC functionality which is often targeted by brute force attacks and is rarely needed in modern WordPress sites.

### Comment & Feed Management

- **[Disable comments](https://github.com/vinkla/headache/blob/main/headache.php#L43)**  
  Turns off the commenting system entirely, useful for sites that don't need user interaction or want to prevent spam.

- **[Disable comments feeds](https://github.com/vinkla/headache/blob/main/headache.php#L38-L39)**  
  Removes RSS feeds for comments, reducing unnecessary feed endpoints.

- **[Disable feeds](https://github.com/vinkla/headache/blob/main/headache.php#L33-L37)**  
  Redirects all RSS/Atom feeds to the homepage, eliminating content syndication endpoints that may not be needed.

### Content & Attachment Management

- **[Disable attachment pages](https://github.com/vinkla/headache/blob/main/headache.php#L219-L233)**  
  Prevents direct access to attachment pages and redirects them to 404, reducing potential SEO issues and security vulnerabilities.

- **[Remove reserved attachment slugs](https://github.com/vinkla/headache/blob/main/headache.php#L259-L278)**  
  Uses UUIDs for attachment slugs instead of predictable names, preventing slug reservation conflicts and improving security.

### Gutenberg & Editor Cleanup

- **[Disable font library](https://github.com/vinkla/headache/blob/main/headache.php#L324-L331)**  
  Disables WordPress 6.5+ font library feature in the block editor, reducing interface complexity for sites that don't need custom fonts.

- **[Remove Gutenberg's front-end block styles](https://github.com/vinkla/headache/blob/main/headache.php#L146-L151)**  
  Removes default block styling to prevent style conflicts and reduce CSS bloat.

- **[Remove Gutenberg's core block styles](https://github.com/vinkla/headache/blob/main/headache.php#L157-L162)**  
  Removes core block support styles for cleaner CSS output.

- **[Remove Gutenberg's global styles](https://github.com/vinkla/headache/blob/main/headache.php#L167-L172)**  
  Removes global theme styles added by Gutenberg to prevent theme conflicts.

- **[Remove Gutenberg's SVG filters](https://github.com/vinkla/headache/blob/main/headache.php#L177-L182)**  
  Removes SVG filters primarily used in Full Site Editing that add unnecessary markup.

- **[Remove classic theme styles](https://github.com/vinkla/headache/blob/main/headache.php#L174-L179)**  
  Removes backwards compatibility styles for classic themes when using block themes.

- **[Remove blocked HTML elements from TinyMCE when pasting text](https://github.com/vinkla/headache/blob/main/headache.php#L286-L322)**  
  Sanitizes pasted content in the classic editor by removing unwanted HTML tags and attributes.

### Performance & Cleanup

- **[Remove ?ver= query from styles and scripts](https://github.com/vinkla/headache/blob/main/headache.php#L188-L209)**  
  Removes version query parameters from asset URLs for cleaner URLs and better caching.

- **[Remove JPEG compression](https://github.com/vinkla/headache/blob/main/headache.php#L121-L128)**  
  Sets JPEG quality to 100% to prevent WordPress from compressing uploaded images.

### SEO & Indexing

- **[Discourage search engines from indexing in non-production environments](https://github.com/vinkla/headache/blob/main/headache.php#L280-L285)**  
  Automatically discourages search engine indexing in development, staging, and testing environments.

### User Role Management

- **[Remove contributor, subscriber and author roles](https://github.com/vinkla/headache/blob/main/headache.php#L211-L217)**  
  Removes unnecessary user roles for sites that only need administrators and editors.

### Meta Tag & Link Cleanup

- **[Remove all extra RSS feed links](https://github.com/vinkla/headache/blob/main/headache.php#L67)**  
  Removes extra RSS feed discovery links from the HTML head section.

- **[Remove emojis](https://github.com/vinkla/headache/blob/main/headache.php#L82-L90)**  
  Removes emoji detection scripts and styles, reducing page load times and preventing emoji-related issues.

- **[Remove generated icons](https://github.com/vinkla/headache/blob/main/headache.php#L56)**  
  Removes automatically generated site icon links from the HTML head.

- **[Remove language dropdown on login screen](https://github.com/vinkla/headache/blob/main/headache.php#L45)**  
  Hides the language selector on the login page for cleaner login experience.

- **[Remove meta rel=dns-prefetch href=//s.w.org](https://github.com/vinkla/headache/blob/main/headache.php#L72)**  
  Removes DNS prefetch hint for WordPress.org servers, improving privacy and reducing external requests.

- **[Remove oEmbeds](https://github.com/vinkla/headache/blob/main/headache.php#L101-L102)**  
  Removes oEmbed discovery links and scripts, preventing automatic embedding of external content.

- **[Remove Really Simple Discovery link](https://github.com/vinkla/headache/blob/main/headache.php#L62)**  
  Removes RSD link used by blog clients, which is rarely needed in modern WordPress sites.

- **[Remove relational links for the posts](https://github.com/vinkla/headache/blob/main/headache.php#L74)**  
  Removes prev/next post links from HTML head to reduce clutter.

- **[Remove REST API link tag from `<head>` and HTML headers](https://github.com/vinkla/headache/blob/main/headache.php#L76-L80)**  
  Removes REST API discovery links for cleaner HTML output.

- **[Remove RSS feed links](https://github.com/vinkla/headache/blob/main/headache.php#L64)**  
  Removes main RSS feed discovery links from the HTML head.

- **[Remove shortlink tag from `<head>` and HTML headers](https://github.com/vinkla/headache/blob/main/headache.php#L58-L61)**  
  Removes shortlink meta tags and HTTP headers for cleaner output.

- **[Remove wlwmanifest.xml](https://github.com/vinkla/headache/blob/main/headache.php#L69)**  
  Removes Windows Live Writer manifest link, which is obsolete and unnecessary.

- **[Remove WordPress version](https://github.com/vinkla/headache/blob/main/headache.php#L53)**  
  Removes WordPress version meta tag for security through obscurity.

### Login Page Customization

- **[Update login page image link URL](https://github.com/vinkla/headache/blob/main/headache.php#L130-L135)**  
  Changes the login page logo link to point to your site instead of WordPress.org.

- **[Update login page link title](https://github.com/vinkla/headache/blob/main/headache.php#L137-L142)**  
  Updates the login page logo title attribute to show your site name instead of "WordPress".
