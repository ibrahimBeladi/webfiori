<?php
/* 
 * The MIT License
 *
 * Copyright 2020 Ibrahim Al-Beladi.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
namespace webfiori\examples\views;

use webfiori\entity\Page;

use phpStructs\html\JsCode;

use phpStructs\html\PNode;
use phpStructs\html\HTMLNode;
use phpStructs\html\UnorderedList;

class VuetifyPage {
    public function __construct() {
        Page::title('Vue + Vuetify Example');
        Page::description('A basic example that uses Vue and Vuetify frameworks');

        $this->includeCSS();
        $this->includeBody();
        $this->includeJS();

        $localhosts = array('127.0.0.1', "::1");
        $isLocalhost = false;

        if(in_array($_SERVER['REMOTE_ADDR'], $localhosts)){
            $isLocalhost = true;
        }
        Page::render(false, $isLocalhost);
    }

    private function includeCSS() {
        $vuetifycss = new HTMLNode("link");
        $vuetifycss->setAttribute("rel", "stylesheet");
        $vuetifycss->setAttribute("href", "https://cdn.jsdelivr.net/npm/vuetify@2.2.3/dist/vuetify.min.css");
        Page::insert($vuetifycss);

        $vuetifycss = new HTMLNode("style");
        $vuetifycss->addTextNode("[v-cloak]{display: none;}");
        Page::insert($vuetifycss);
    }

    private function includeBody() {
        $app = new HTMLNode('v-app');
        $app->setID("app");
        $app->setAttribute("v-cloak"); // to hide dom before loading vuetify
        Page::insert($app);

        $app->addTextNode("
            <v-app-bar color='primary' app dense clipped-left>
                <v-toolbar-title>
                    <v-avatar>
                        <v-img src='./themes/greeny/images/favicon.png'></v-img>
                    </v-avatar>
                </v-toolbar-title>
                <v-toolbar-items>
                    <v-btn text class='text-none'>
                        Download
                    </v-btn>
                    <v-btn text class='text-none'>
                        API Docs
                    </v-btn>
                    <v-btn text class='text-none'>
                        Learn
                    </v-btn>
                    <v-btn text class='text-none'>
                        Contribute
                    </v-btn>
                </v-toolbar-items>
            </v-app-bar>
        ", false);

        $app->addTextNode("
            <v-navigation-drawer color='primary' app clipped>
                <v-list dense nav>
                    <v-list-item @click='\$vuetify.goTo(0)'>
                        <v-list-item-content>
                            <v-list-item-title>Top</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item @click='\$vuetify.goTo(\"#what\", { offset : 20 })'>
                        <v-list-item-content>
                            <v-list-item-title>What is WebFiori Framework?</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item @click='\$vuetify.goTo(\"#features\", { offset : 20 })'>
                        <v-list-item-content>
                            <v-list-item-title>Key Features</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item @click='\$vuetify.goTo(\"#download\", { offset : 20 })'>
                        <v-list-item-content>
                            <v-list-item-title>Downloading The Framework</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item @click='\$vuetify.goTo(\"#free\", { offset : 20 })'>
                        <v-list-item-content>
                            <v-list-item-title>Is it free to use?</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item @click='\$vuetify.goTo(\"#why\", { offset : 20 })'>
                        <v-list-item-content>
                            <v-list-item-title>Why did you build such framework since there are many good ones already out there?</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>
        ", false);

        $content = new HTMLNode('v-content');
        $content->setAttribute("app");
        $app->addChild($content);

        $container = new HTMLNode('v-container');
        $content->addChild($container);

        $container->addTextNode("
            <v-card outlined class='my-5'>
                <v-card-text class='black--text title'>
                    <div class='secondary--text'>Do you want to build:</div>
                    <ul class='body-1'>
                        <li>
                            a website with customizable user interface?
                        </li>
                        <li>
                            a complicated web application with session management and database access? 
                        </li>
                        <li>
                            web APIs for your mobile app?
                        </li>
                    </ul>
                </v-card-text>

                <v-card-title class='secondary--text'>
                    If this is the case, then WebFiori Framework is your choice.
                </v-card-title>
            </v-card>
        ", false);

        $container->addTextNode("
            <v-card outlined class='my-5' id='what'>
                <v-card-title class='secondary--text'>
                    What is WebFiori Framework?
                </v-card-title>

                <v-card-text class='black--text'>
                    WebFiori Framework is a web framework which is built using PHP language. The framework is fully object oriented (OOP). It allows the use of the famous model-view-controller (MVC) model but it does not force it. The framework comes with many features which can help in making your website or web application up and running in no time.
                </v-card-text>
            </v-card>
        ", false);

        $container->addTextNode("
            <v-card outlined class='my-5' id='features'>
                <v-card-title class='secondary--text'>
                    Key Features
                </v-card-title>

                <v-card-text class='black--text'>
                    <ul>
                        <li>Theming and the ability to create multiple UIs for the same web page using any CSS or JavaScript framework.</li>
                        <li>Support for routing that makes the ability of creating search-engine-friendly links an easy task.</li>
                        <li>Creation of web APIs that supports JSON, data filtering and validation.</li>
                        <li>Basic support for MySQL schema and query building.</li>
                        <li>Lightweight. The total size of framework core files is less than 3 megabytes.</li>
                        <li>Access management by assigning system user a set of privileges.</li>
                        <li>The ability to create and manage multiple sessions at once.</li>
                        <li>Support for creating and sending nice-looking emails in a simple way by using SMTP protocol.</li>
                        <li>Autoloading of user defined classes.</li>
                        <li>The ability to create automatic tasks and let them run in specific time using CRON.</li>
                        <li>Support for logging of system events.</li>
                        <li>Well-defined file upload and file handling sub-system.</li>
                        <li>Building and manipulating the DOM of a web page using PHP language.</li>
                    </ul>
                </v-card-text>
            </v-card>
        ", false);

        $container->addTextNode("
            <v-card outlined class='my-5' id='download'>
                <v-card-title class='secondary--text'>
                    Downloading The Framework
                </v-card-title>

                <v-card-text class='black--text'>
                    Please go to downloads page to check the available download options. After completing the download process, you can go to learning center in order to get started.
                </v-card-text>
            </v-card>
        ", false);

        $container->addTextNode("
            <v-card outlined class='my-5' id='free'>
                <v-card-title class='secondary--text'>
                    Is it free to use?
                </v-card-title>

                <v-card-text class='black--text'>
                    Yes for sure. You can use it for free of charge. In addition, it is open source. This means you can modify the source code of the framework the way you like as long as you follow MIT license regarding open source software modifications.                
                </v-card-text>
            </v-card>
        ", false);

        $container->addTextNode("
            <v-card outlined class='my-5' id='why'>
                <v-card-title class='secondary--text'>
                    Why did you build such framework since there are many good ones already out there?
                </v-card-title>

                <v-card-text class='black--text'>
                    <p>One of the reasons is <b>simplicity</b>. Some of the available frameworks makes it difficult for you to develop your website or web application by overwhelming you with many features which you don't actually need. WebFiori Framework gives you the simplest set of tools that you would need to setup a website, web application or web APIs.</p>
                    <p>Another reason is the <b>ease of use</b>. Many of the available frameworks aren't easy to master in short time. While developing the framework, one of the things that we put in mind is how to help developers learn how to use the framework in no time. If you want to create static web pages (HTML only), then you only need to learn about routing. You might need to learn more if you want to use PHP features for your web pages. If you want to create a nice looking pages, You need to learn about the basics of theming in the framework. If you want to develop web APIs, Then you need to learn about routing plus creating API classes.</p>
                    <p>The final reason is <b>learning</b>. While building the framework, I (The developer of the framework) learned many new concepts which I did not know about while I was student at university. Building something new from scratch was a good chance to learn new things and to put my skills into something that can help me and others.</p>
                </v-card-text>
            </v-card>
        ", false);

        $app->addTextNode("
            <v-footer padless clipped>
                <v-card flat outlined width='100%' class='tertiary black--text text-center'>
                    <v-card-text class='py-2'>
                        <a v-for='link in [\"GitHub\",\"Twitter\",\"Telegram\"]' :key='link' class='blue--text px-2' small>
                            {{ link }}
                        </a>
                    </v-card-text>

                    <v-card-text class='py-0'>
                        Powered by: WebFiori Framework v1.0.8. Code licensed under the MIT License.
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-text class='py-2'>
                        <v-avatar size='30px'>
                            <v-img src='./themes/greeny/images/favicon.png'></v-img>
                        </v-avatar>
                        <br/>
                        All Rights Reserved © {{ new Date().getFullYear() }}
                    </v-card-text>
                </v-card>
            </v-footer>
        ", false);
    }

    private function includeJS() {
        $vuejs = new JsCode();
        $vuejs->setAttribute("src", "https://cdn.jsdelivr.net/npm/vue@2.6.11/dist/vue.js");
        Page::insert($vuejs);

        $vuetifyjs = new JsCode();
        $vuetifyjs->setAttribute("src", "https://cdn.jsdelivr.net/npm/vuetify@2.2.3/dist/vuetify.js");
        Page::insert($vuetifyjs);

        $vueApp = new JsCode();
        $vueApp->addCode("
                new Vue({
                    el: '#app',
                    vuetify: new Vuetify({
                        theme: {
                            themes: {
                                light: {
                                    primary: '#c1ec9b',
                                    secondary: '#167442',
                                    tertiary: '#eeeeff',
                                },
                                dark: {
                                    //
                                }
                            },
                            dark: false
                        }
                    }),
                });
            ");
        Page::insert($vueApp);
    }
    
}

return __NAMESPACE__;