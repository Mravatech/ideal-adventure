#!/usr/bin/env bash
# wait-for-it.sh

file=$1

until [ -f "$file" ]; do
  >&2 echo "Waiting for $file to be created..."
  sleep 1
done

>&2 echo "$file found. Continuing..."
