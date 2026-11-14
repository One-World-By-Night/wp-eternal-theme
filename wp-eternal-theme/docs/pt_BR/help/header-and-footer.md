# Cabeçalho e rodapé

A barra no alto de toda página e a faixa no pé. Os dois são modelos do Elementor que você edita como qualquer página.

## Quem pode usar

Administradores do site.

## Como chegar

wp-admin → **Templates** → **Saved Templates** (no Elementor mais antigo, **Elementor** → **My Templates**) → **WP Eternal – Header** ou **WP Eternal – Footer**.

## A tela

- **WP Eternal – Header** - o logo do site à esquerda, ligado à página inicial, e o menu à direita. Ele fica fixo no alto, e encolhe quando o leitor rola a página para baixo.
- **WP Eternal – Footer** - a linha de copyright.
- Os dois aparecem no site inteiro.

## Tarefas comuns

### Mudar o cabeçalho

1. Abra **WP Eternal – Header** com **Edit with Elementor**.
2. Faça a mudança: troque o logo, acrescente um botão, mude o estilo da barra.
3. Clique em **Publish**.

### Pôr páginas no menu do cabeçalho

1. Vá a **Appearance** → **Menus**.
2. Monte o menu, marque **Header** em **Display location** e clique em **Save Menu**.

### Mudar o logo

1. Vá a **Appearance** → **Customize** → **Site Identity**.
2. Escolha o logo e publique.

## Bom saber

- O tema cria os dois modelos na primeira vez que é ligado num site, e nunca mais enquanto eles existirem.
- Mantenha a classe CSS `main--header` do cabeçalho: o efeito de rolagem e os estilos do modo escuro a procuram.
- Os dois modelos precisam do Elementor Pro, que os mostra no site inteiro.

## Solução de problemas

- **O cabeçalho ou o rodapé sumiu ou está sem estilo.** Confira se os dois modelos existem e aparecem no **Entire Site**. Se foram apagados, troque para outro tema e volte: o tema os cria de novo.
- **Sem menu no cabeçalho.** Nenhum menu está ligado à posição dele. Veja **Pôr páginas no menu do cabeçalho**.

## Relacionados

- [Montar páginas](building-pages.md)
- [Cores da marca e modo escuro](brand-colors.md)
- [Solução de problemas do tema](troubleshooting.md)
