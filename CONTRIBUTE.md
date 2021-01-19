# Contributing

Contributions are welcome. I accept merge requests on [GitHub][].
This project follows semantic versioning and the [semantic branching model][].

## Communication Channels

You can find help and discussion in the following places:

- [GitHub Issues][issues]

## Reporting Bugs

Bugs get tracked in the project's [issue tracker][issues].

When submitting a bug report, please include enough information to reproduce the
bug. A good bug report includes the following sections:

- Given input
- Expected output
- Actual output
- Steps to reproduce, including sample code
- Any other information that will help debug and reproduce the issue, including
  stack traces, system/environment information, screenshots or at best a 
  merge request with a test scenario which proofs the error.

## Fixing Bugs

I welcome merge requests to fix bugs!

If you see a bug report that you'd like to fix, please feel free to do so.
See the [bug fixes][] section of the [semantic branching model][] documentation.

## Adding New Features

If you have an idea for a new feature, it's a good idea to check out the
[issues][] or active [merge requests][] first to see if the feature has already
requested and being worked on. If not, feel free to submit an issue first, asking 
whether the feature is beneficial to the project. This will save you from doing a
lot of development work only to have your feature rejected. I don't enjoy rejecting
your hard work, but some features just don't fit with the goals of the project.

When you do begin working on your feature, here are some guidelines to consider:

- Check the [branch semantics][] section of the [semantic branching model][] documentation.
- Your merge request description should clearly detail the changes you have made.
  I will use this description to update the CHANGELOG. If there is no
  description, or it does not adequately describe your feature, I will ask you
  to update the description.
- This package follows the **[PSR-2 coding standard][psr-2]**. Please
  ensure your code does, too.
- Please **write tests** for any new features you add.
- Please **ensure that tests pass** before submitting your merge request.
  This package has automatically running tests for merge requests.
  However, running the tests locally will help save time.
- Use **feature/{issue-id}.** branches. Please do not ask to merge from your master
  branch.
- **Submit one feature per merge request.** If you have multiple features you
  wish to submit, please break them up into separate merge requests. 
- **Write good commit messages.** Make sure each individual commit in your merge
  request is meaningful. If you had to make multiple intermediate commits while
  developing, please squash them before submitting.


## Running Tests and Linters

The following must pass before I will accept a merge request. If this does not
pass, it will result in a complete build failure. Before you can run this, be
sure to `composer install`.

To run all the tests and coding standards checks, execute the following from the
command line, while in the project root directory:

```
php vendor/bin/php-cs-fix fix src --dry-run
php vendor/bin/psalm
php vendor/bin/phpunit
```

[GitHub]: https://github.com/michaelpetri/typed-input
[issues]: https://github.com/michaelpetri/typed-input/issues
[bug fixes]: https://dev-cafe.github.io/branching-model#bugfixes
[branch semantics]: https://dev-cafe.github.io/branching-model/#branch-semantics
[merge reqeusts]: https://github.com/michaelpetri/typed-input/compare
[semantic branching model]: https://dev-cafe.github.io/branching-model