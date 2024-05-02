#! /bin/zsh

if [[ $(pwd) =~ "wp-content/themes" ]];
then
    eslint '{src,blocks}/**/*.{js,ts,tsx}'
else
    eslint 'wp-content/themes/**/{src,blocks}/**/*.{js,ts,tsx}'
fi

