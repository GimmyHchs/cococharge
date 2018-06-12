# Change Log

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

<a name="0.4.0"></a>
# [0.4.0](https://github.com/g9308370/cococharge/compare/v0.3.0...v0.4.0) (2018-06-12)


### Bug Fixes

* **line:** fix timestamp&reply_token issue ([a2d4439](https://github.com/g9308370/cococharge/commit/a2d4439))
* **line:** remove useless line classes ([710f46a](https://github.com/g9308370/cococharge/commit/710f46a))
* **timezone:** set timezone to UTC+8 ([19f2ecc](https://github.com/g9308370/cococharge/commit/19f2ecc))


### Features

* **line:** add join parser and join eloquent ([ca5bc0e](https://github.com/g9308370/cococharge/commit/ca5bc0e))
* **line:** add message generator factory & text generator ([e4023e0](https://github.com/g9308370/cococharge/commit/e4023e0))
* **line:** add message text & relations ([7db8825](https://github.com/g9308370/cococharge/commit/7db8825))
* **line:** add message webhook parser ([035f7b2](https://github.com/g9308370/cococharge/commit/035f7b2))
* **line:** add origin_data into migration and eloquent ([c95fe68](https://github.com/g9308370/cococharge/commit/c95fe68))
* **line:** add UndefinedEventTypeException. ([544d48d](https://github.com/g9308370/cococharge/commit/544d48d))
* **line:** build webhook event's interface ([c71e3f8](https://github.com/g9308370/cococharge/commit/c71e3f8))
* **line:** handle webhook exception ([243c610](https://github.com/g9308370/cococharge/commit/243c610))
* **line:** nested factory pattern. auto generate line message eloquent ([0310a31](https://github.com/g9308370/cococharge/commit/0310a31))
* **line:** parse follow webhook event ([586e9f2](https://github.com/g9308370/cococharge/commit/586e9f2))
* **line:** parse leave webhook event ([71bfa4d](https://github.com/g9308370/cococharge/commit/71bfa4d))
* **line:** parse unfollow webhook event ([88f6c67](https://github.com/g9308370/cococharge/commit/88f6c67))
* **log:** add log-viewer ([94806f3](https://github.com/g9308370/cococharge/commit/94806f3))



<a name="0.3.0"></a>
# [0.3.0](https://github.com/g9308370/cococharge/compare/v0.2.1...v0.3.0) (2018-06-06)


### Features

* **line:** add line bot and reply service ([b77c9e9](https://github.com/g9308370/cococharge/commit/b77c9e9))
* **line:** add line webhook ([d7a1f0f](https://github.com/g9308370/cococharge/commit/d7a1f0f))
* **line:** get first reply token from hookevents ([62825a0](https://github.com/g9308370/cococharge/commit/62825a0))
* **line:** wrap LineClient class ([ce1db31](https://github.com/g9308370/cococharge/commit/ce1db31))



<a name="0.2.1"></a>
## [0.2.1](https://github.com/g9308370/cococharge/compare/v0.2.0...v0.2.1) (2018-06-04)


### Bug Fixes

* **drone:** user private dockerhub repo ([1913fff](https://github.com/g9308370/cococharge/commit/1913fff))



<a name="0.2.0"></a>
# [0.2.0](https://github.com/g9308370/cococharge/compare/v0.1.0...v0.2.0) (2018-06-02)


### Features

* **'view':** change welcome page text ([50a201b](https://github.com/g9308370/cococharge/commit/50a201b))
* **drone:** add develop to deploy ([34285c0](https://github.com/g9308370/cococharge/commit/34285c0))
* **http:** add http&https setting, force to use config's host url ([10da9ff](https://github.com/g9308370/cococharge/commit/10da9ff))
* **line:** add HookeventParser ([6ac9090](https://github.com/g9308370/cococharge/commit/6ac9090))
* **line:** add line eloquents & relations ([afb462a](https://github.com/g9308370/cococharge/commit/afb462a))



<a name="0.1.0"></a>
# 0.1.0 (2018-05-27)


### Bug Fixes

* **drone:** prune all image when deploy ([e3316ee](https://github.com/g9308370/cococharge/commit/e3316ee))
* **drone:** use bash to trigger standard-version ([deb9f86](https://github.com/g9308370/cococharge/commit/deb9f86))


### Features

* **account:** add user & line user model ([4e57f20](https://github.com/g9308370/cococharge/commit/4e57f20))
* **drone:** auto deploy to server ([a4c47ff](https://github.com/g9308370/cococharge/commit/a4c47ff))
* **drone:** clone env from private repo ([2e073af](https://github.com/g9308370/cococharge/commit/2e073af))
* **drone:** validate coding style after push ([e4f0372](https://github.com/g9308370/cococharge/commit/e4f0372))
* **migration:** add legacy migrations ([d9bb0a0](https://github.com/g9308370/cococharge/commit/d9bb0a0))
* **package:** add debugbar & guzzle ([e8e9bdf](https://github.com/g9308370/cococharge/commit/e8e9bdf))
* **test:** build unit test structure ([02d6502](https://github.com/g9308370/cococharge/commit/02d6502))
