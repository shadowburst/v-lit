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
            buildInputs = [
              php83
              php83Packages.composer
              nodejs_22
            ];
            shellHook = ''
              alias php="docker exec -it template.php php"
              alias composer="docker exec -it template.php composer"
              alias npm="docker exec -it template.node npm"
              alias node="docker exec -it template.node node"
            '';
          };
        };
      }
    );
}
