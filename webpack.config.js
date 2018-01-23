const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const domain = 'http://krframe.dev';

let config = {
    entry: {
        main: [
            './_dev/js/template.js',
            './_dev/scss/template.scss'
        ]
    },
    output: {
        path: path.resolve(__dirname, 'assets/js'),
        filename: 'main.script.js'
    },
    module: {
        rules: [{
                test: /\.js/,
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['env'],
                },
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: 'style-loader',
                    use: [{
                            loader: 'css-loader',
                            options: {
                                minimize: true
                            }
                        },
                        'postcss-loader',
                        'sass-loader'
                    ]
                })
            },
            {
                test: /.(png|jpg|woff(2)?|eot|ttf|svg)(\?[a-z0-9=\.]+)?$/,
                use: [{
                    loader: 'file-loader',
                    options: {
                        name: '../css/[hash].[ext]'
                    }
                }]
            },
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader', 'postcss-loader']
            }
        ]
    },
    externals: {
        $: '$',
        jquery: 'jQuery'
    },
    plugins: [
        new ExtractTextPlugin(path.join('..', 'css', 'theme.css')),
        new BrowserSyncPlugin({
            host: 'localhost',
            port: 3000,
            proxy: domain,
            files: [
                'twig/*.twig',
                'twig/**/*.twig',
                '*.php',
            ]
        })
    ]
};

config.plugins.push(
    new webpack.optimize.UglifyJsPlugin({
        sourceMap: false,
        compress: {
            sequences: true,
            conditionals: true,
            booleans: true,
            if_return: true,
            join_vars: true,
            drop_console: true
        },
        output: {
            comments: false
        },
        minimize: true
    })
);

module.exports = config;
