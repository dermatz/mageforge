# Contributing to MageForge

## Submit Pull-Requests

1.  Create an [Issue](https://github.com/dermatz/mageforge/issues) as either a feature request or bug report. Please ensure the ticket includes all relevant information
2.  Fork this project, then create a new branch for your work that is related to the issue you created
3.  Commit your changes to the new branch and open a Pull Request to this repository branch: `main`

---

## Coding Quality

- Use the Magento Coding Standards
- Run `trunk check` to validate your code against our coding rules, otherwise our pipeline will do that ;)

## Documentation

- Use the [Markdown Syntax](https://www.markdownguide.org/basic-syntax/) for documentation files

## License

a) Read the [LICENSE](./LICENSES) file for License Information
b) All of your contributions will be also licensed under the MIT License

---

## Code Formatting

- Indent code with 4 spaces
- Use meaningful variable and function names
- Keep lines under 80 characters where possible
- User `trunk check` to lint your code

---

## VSCODE USERS

VSCode User automaticly use our VSCode Workspace Settings, located in `.vscode/settings.json`.
We support [Git commit message helper](https://marketplace.visualstudio.com/items?itemName=D3skdev.git-commit-message-helper) to add
correct commit message with prefixes based on your branch name given from github with issue-id.
e.G. `#123 - Commit Message ...`

![Demo Git commit message helper](https://github.com/d3skdev/git-prefix/raw/master/images/demo.gif)

---

## Best Practices

- Write clear and concise comments
- Add Description to functions, classes and parameters
- Test your code thoroughly before submitting

---

## Code Review Process

- Submit your pull request for review
- Request a Code Review from a Maintainer
- Address any feedback or requested changes
- Ensure all tests pass before merging
