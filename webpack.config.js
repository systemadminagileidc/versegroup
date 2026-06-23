// webpack.config.js

const path = require("path")

module.exports = {
    entry: {
        main: "./web/assets/JS/_webpack/main.js",
    },
    output: {
        path: path.join(__dirname, './'),
        filename: "[name].min.js",
    },
    optimization: {
        minimize: true
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: "babel-loader",
                options: {
                    presets: ["@babel/preset-env"],
                },
            },
        ],
    },
    mode: 'production'
}