# Solução de problemas do tema

Soluções para o que mais dá errado com o tema: um cabeçalho que some, cores no modo escuro e plugins que faltam.

## Quem pode usar

Administradores do site e quem edita páginas.

## Como chegar

A maioria das soluções começa em wp-admin → **Appearance**.

## A tela

A maioria das soluções usa [Cabeçalho e rodapé](header-and-footer.md) e [Plugins obrigatórios](required-plugins.md).

## Tarefas comuns

### Trazer de volta um cabeçalho ou rodapé apagado

1. Vá a **Appearance** → **Themes** e troque para outro tema.
2. Volte para o WP Eternal Theme. Ele cria de novo qualquer cabeçalho ou rodapé que falte.

## Bom saber

- O cabeçalho e o rodapé precisam do Elementor e do Elementor Pro.
- As cores acompanham o modo escuro só quando são cores globais.

## Solução de problemas

- **O cabeçalho ou o rodapé sumiu ou está sem estilo.** O Elementor Pro não está ativo, ou os modelos não aparecem no site inteiro. Veja [Cabeçalho e rodapé](header-and-footer.md).
- **Sem menu no cabeçalho.** Em **Appearance** → **Menus**, marque **Header** em **Display location** para um menu.
- **O texto está ilegível no modo escuro.** Ele usa uma cor digitada; troque-a por uma cor global.
- **O site mostra um erro depois de uma atualização do WP Dark Mode.** As duas partes dele estão em versões diferentes. Atualize as duas para a mesma.
- **Um autor não acha um doc ou uma tabela.** Ele pertence a outro autor, veja [Docs e tabelas dos autores](author-tools.md).

## Relacionados

- [Cabeçalho e rodapé](header-and-footer.md)
- [Plugins obrigatórios](required-plugins.md)
- [Visão geral do WP Eternal Theme](../overview.md)
