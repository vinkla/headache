# Headache

> An easy-to-swallow painkiller plugin for WordPress.

The plugin removes a lot of default WordPress stuff you just can't wait to get rid of. It removes meta tags such as feeds, version numbers and emojis.

[![Build Status](https://img.shields.io/github/actions/workflow/status/vinkla/headache/php-cs-fixer.yml?label=tests)](https://github.com/vinkla/headache/actions)
[![Monthly Downloads](https://img.shields.io/packagist/dm/vinkla/headache)](https://packagist.org/packages/vinkla/headache/stats)
[![Latest Version](https://img.shields.io/packagist/v/vinkla/headache)](https://packagist.org/packages/vinkla/headache)

## Installation

Require the package, with Composer, in the root directory of your project.

```sh
composer require vinkla/headache
```

The plugin will be installed as a [must-use plugin](https://github.com/vinkla/wordplate#must-use-plugins).

## Features

All features are activated by default when the plugin is activated.

### Security Features

- **[Disable default users API endpoints for security](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L106-L121)**  
  Prevents unauthorized enumeration of usernames through REST API endpoints, enhancing site security against username discovery attacks.

- **[Disable XML RPC for security](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L50-L52)**  
  Disables XML-RPC functionality which is often targeted by brute force attacks and is rarely needed in modern WordPress sites.

### Comment & Feed Management

- **[Disable comments](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L44-L45)**  
  Turns off the commenting system entirely, useful for sites that don't need user interaction or want to prevent spam.

- **[Disable comments feeds](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L40-L42)**  
  Removes RSS feeds for comments, reducing unnecessary feed endpoints.

- **[Disable feeds](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L26-L38)**  
  Redirects all RSS/Atom feeds to the homepage, eliminating content syndication endpoints that may not be needed.

### Content & Attachment Management

- **[Disable attachment pages](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L222-L259)**  
  Prevents direct access to attachment pages and redirects them to 404, reducing potential SEO issues and security vulnerabilities.

- **[Remove reserved attachment slugs](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L261-L285)**  
  Uses UUIDs for attachment slugs instead of predictable names, preventing slug reservation conflicts and improving security.

### Gutenberg & Editor Cleanup

- **[Disable loading separate core block assets](https://github.com/vinkla/headache/blob/e48f1320b14feabb5cd2e66d77d196b1ecb0a13d/headache.php#L54-L56)**  
  Disables the loading of separate core block assets to prevent unstyled content and ensure proper style removal.

- **[Disable font library](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L326-L335)**  
  Disables WordPress 6.5+ font library feature in the block editor, reducing interface complexity for sites that don't need custom fonts.

- **[Remove Gutenberg's front-end block styles](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L149-L156)**  
  Removes default block styling to prevent style conflicts and reduce CSS bloat.

- **[Remove Gutenberg's core block styles](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L158-L163)**  
  Removes core block support styles for cleaner CSS output.

- **[Remove Gutenberg's global styles](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L167-L174)**  
  Removes global theme styles added by Gutenberg to prevent theme conflicts.

- **[Remove Gutenberg's SVG filters](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L185-L193)**  
  Removes SVG filters primarily used in Full Site Editing that add unnecessary markup.

- **[Remove classic theme styles](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L176-L183)**  
  Removes backwards compatibility styles for classic themes when using block themes.

- **[Remove auto-sizes contain inline styles](https://github.com/vinkla/headache/blob/26e3b067c398c0220ac5aebf2985d1a757137804/headache.php#L185-L192)**  
  Removes the inline styles added by WordPress 6.7 for auto-sizes lazy-loaded images feature.

- **[Remove blocked HTML elements from TinyMCE when pasting text](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L295-L324)**  
  Sanitizes pasted content in the classic editor by removing unwanted HTML tags and attributes.

### Performance & Cleanup

- **[Remove JPEG compression](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L125-L131)**  
  Sets JPEG quality to 100% to prevent WordPress from compressing uploaded images.

### SEO & Indexing

- **[Discourage search engines from indexing in non-production environments](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L287-L293)**  
  Automatically discourages search engine indexing in development, staging, and testing environments.

### User Role Management

- **[Remove contributor, subscriber and author roles](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L212-L220)**  
  Removes unnecessary user roles for sites that only need administrators and editors.

### Meta Tag & Link Cleanup

- **[Remove all extra RSS feed links](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L72-L73)**  
  Removes extra RSS feed discovery links from the HTML head section.

- **[Remove emojis](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L90-L104)**  
  Removes emoji detection scripts and styles, reducing page load times and preventing emoji-related issues.

- **[Remove generated icons](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L57-L58)**  
  Removes automatically generated site icon links from the HTML head.

- **[Remove language dropdown on login screen](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L47-L48)**  
  Hides the language selector on the login page for cleaner login experience.

- **[Remove meta rel=dns-prefetch href=//s.w.org](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L78-L79)**  
  Removes DNS prefetch hint for WordPress.org servers, improving privacy and reducing external requests.

- **[Remove oEmbeds](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L102-L104)**  
  Removes oEmbed discovery links and scripts, preventing automatic embedding of external content.

- **[Remove Really Simple Discovery link](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L66-L67)**  
  Removes RSD link used by blog clients, which is rarely needed in modern WordPress sites.

- **[Remove relational links for the posts](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L81-L82)**  
  Removes prev/next post links from HTML head to reduce clutter.

- **[Remove REST API link tag from `<head>` and HTML headers](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L84-L88)**  
  Removes REST API discovery links for cleaner HTML output.

- **[Remove RSS feed links](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L69-L70)**  
  Removes main RSS feed discovery links from the HTML head.

- **[Remove shortlink tag from `<head>` and HTML headers](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L60-L64)**  
  Removes shortlink meta tags and HTTP headers for cleaner output.

- **[Remove WordPress version](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L54-L55)**  
  Removes WordPress version meta tag for security through obscurity.

### Login Page Customization

- **[Update login page image link URL](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L133-L139)**  
  Changes the login page logo link to point to your site instead of WordPress.org.

- **[Update login page link title](https://github.com/vinkla/headache/blob/96a91c7446efc70a1031d11a172e3dfb0164b6fa/headache.php#L141-L147)**  
  Updates the login page logo title attribute to show your site name instead of "WordPress".
