{
  description = "dev shell providing project dependencies";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs =
    {
      self,
      nixpkgs,
      flake-utils,
    }:
    flake-utils.lib.eachDefaultSystem (
      system:
      let
        pkgs = import nixpkgs {
          inherit system;
          config.allowUnfree = true;
        };
      in
      with pkgs;
      {
        devShells = {
          default = mkShell {
            shellHook = ''
              alias sail=./vendor/bin/sail
              alias pint="sail php ./vendor/bin/pint"
              alias php="sail php"
              alias composer="sail composer"
              alias npm="sail npm"
              alias node="sail node"
            '';
          };
        };
      }
    );
}
