#!/usr/bin/env bash

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
TARGET_DIR="$SCRIPT_DIR/docker"

if [[ ! -d "$TARGET_DIR" ]]; then
  echo "Папка 'docker' не найдена в $SCRIPT_DIR"
  exit 1
fi

SEPARATOR="----"

print_file() {
  local file="$1"

  # Пропускаем бинарные файлы
  if file --mime "$file" | grep -q 'charset=binary'; then
    return
  fi

  local relative_path="${file#$SCRIPT_DIR/}"

  echo "$SEPARATOR"
  echo "$relative_path:"
  echo "$SEPARATOR"
  cat "$file"
  echo        # первый перенос
  echo        # второй перенос
}

# 1. docker-compose сначала
if [[ -f "$SCRIPT_DIR/docker-compose.yml" ]]; then
  print_file "$SCRIPT_DIR/docker-compose.yml"
elif [[ -f "$SCRIPT_DIR/docker-compose.yaml" ]]; then
  print_file "$SCRIPT_DIR/docker-compose.yaml"
fi

# 2. остальные файлы в docker/
find "$TARGET_DIR" -type f | while IFS= read -r file; do
  case "$(basename "$file")" in
    docker-compose.yml|docker-compose.yaml)
      continue
      ;;
  esac

  print_file "$file"
done
